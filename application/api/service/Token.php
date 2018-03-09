<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 09/03/2018
 * Time: 11:49
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use function array_key_exists;
use function config;
use function is_array;
use function json_decode;
use function md5;
use Exception;
use think\facade\Cache;
use think\facade\Request;

class Token
{
    protected static function generateToken()
    {
        //32个字符组成一组随机字符串
        $randChars = getRandChar(32);

        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        $salt = config('secure.token_salt');


        return md5($randChars . $timestamp . $salt);
    }

    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        } else {

            if (!is_array($vars))
                $vars = json_decode($vars, true);

            if (array_key_exists($key, $vars))
                return $vars[$key];
            else
                throw new Exception('尝试获取Token变量不存在');
        }
    }


    public static function getCurrentUID()
    {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
}