<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 09/03/2018
 * Time: 18:17
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    // HTTP 状态码
    public $code = 403;
    // 错误信息
    public $msg = '权限不足';
    // 自定义错误码
    public $errorCode = 10001;
}