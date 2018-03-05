<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 04/03/2018
 * Time: 22:13
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    // HTTP 状态码
    public $code = 404;
    // 错误信息
    public $msg = 'BANNER INFO DOES NOT EXIST';
    // 自定义错误码
    public $errorCode = 40000;
}