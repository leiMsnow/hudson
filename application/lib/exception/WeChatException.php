<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 08/03/2018
 * Time: 18:49
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    // HTTP 状态码
    public $code = 400;
    // 错误信息
    public $msg = '请求参数错误';
    // 自定义错误码
    public $errorCode = 999;
}