<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 08/03/2018
 * Time: 18:05
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();

        $userToken = new UserToken($code);
        $token = $userToken->get();

        return [
            'token' => $token
        ];
    }
}