<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 08/03/2018
 * Time: 11:24
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    // HTTP 状态码
    public $code = 404;
    // 错误信息
    public $msg = '分类信息不存在';
    // 自定义错误码
    public $errorCode = 50000;
}