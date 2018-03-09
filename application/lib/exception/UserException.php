<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 09/03/2018
 * Time: 16:35
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    // HTTP 状态码
    public $code = 404;
    // 错误信息
    public $msg = '用户信息不存在';
    // 自定义错误码
    public $errorCode = 60000;
}