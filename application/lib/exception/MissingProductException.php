<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 07/03/2018
 * Time: 18:51
 */

namespace app\lib\exception;


class MissingProductException extends BaseException
{
    // HTTP 状态码
    public $code = 404;
    // 错误信息
    public $msg = '商品信息不存在';
    // 自定义错误码
    public $errorCode = 20000;

}