<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 07/03/2018
 * Time: 17:41
 */

namespace app\lib\exception;


class MissingThemeException extends BaseException
{

    // HTTP 状态码
    public $code = 404;
    // 错误信息
    public $msg = '主题不存在';
    // 自定义错误码
    public $errorCode = 30000;

}