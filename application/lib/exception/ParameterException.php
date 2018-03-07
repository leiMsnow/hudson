<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 05/03/2018
 * Time: 12:05
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    // HTTP 状态码
    public $code = 400;
    // 错误信息
    public $msg = '请求参数错误';
    // 自定义错误码
    public $errorCode = 10000;
}