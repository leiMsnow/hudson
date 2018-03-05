<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 04/03/2018
 * Time: 22:09
 */

namespace app\lib\exception;


use Exception;

class BaseException extends Exception
{
    // HTTP 状态码
    public $code = 400;
    // 错误信息
    public $msg = 'INVALID REQUEST';
    // 自定义错误码
    public $errorCode = 10000;

}