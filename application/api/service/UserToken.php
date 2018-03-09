<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 08/03/2018
 * Time: 18:15
 */

namespace app\api\service;


use app\api\model\User;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use function array_key_exists;
use function cache;
use function config;
use Exception;
use function json_decode;
use function json_encode;
use function sprintf;
use const true;

use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wechat.app_id');
        $this->wxAppSecret = config('wechat.app_secret');
        $this->wxLoginUrl = sprintf(config('wechat.login_url'),
            $this->wxAppID, $this->wxAppSecret, $this->code);
    }


    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            throw new Exception('获取session_key、openid异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }

    private function processLoginError($wxResult)
    {
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);
    }

    private function grantToken($wxResult)
    {
        // 拿到openid
        $openid = $wxResult['openid'];
        // 查找数据库中是否存在记录
        $user = UserModel::getByOpenID($openid);
        // 存在直接拿出uid
        if ($user) {
            $uid = $user->id;
        } // 不存在先新增数据
        else {
            $uid = $this->newUser($openid);
        }
        // 生成令牌，准备缓存数据
        $cacheValue = $this->prepareCacheValue($wxResult, $uid);
        //写入缓存
        $token = $this->saveToCache($cacheValue);

        return $token;
    }

    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid,
        ]);
        return $user->id;
    }

    private function prepareCacheValue($wxResult, $uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = ScopeEnum::User;
        return $cacheValue;
    }

    private function saveToCache($cacheValue)
    {
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire_in = config('settings.token_expire_in');

        $request = cache($key, $value, $expire_in);
        if (!$request) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }

}