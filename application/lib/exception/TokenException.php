<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 09/03/2018
 * Time: 12:55
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    // HTTP 状态码
    public $code = 401;
    // 错误信息
    public $msg = 'Token已过期或者无效';
    // 自定义错误码
    public $errorCode = 10002;
}