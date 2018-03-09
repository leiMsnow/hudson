<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 09/03/2018
 * Time: 11:49
 */

namespace app\api\service;


use function config;
use function md5;

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
}