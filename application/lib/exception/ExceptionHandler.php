<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 04/03/2018
 * Time: 22:06
 */

namespace app\lib\exception;


use function json;
use think\exception\Handle;

class ExceptionHandler extends Handle
{
    public function render(\Exception $e)
    {
        return json('class ExceptionHandler extends Handle');
    }

}