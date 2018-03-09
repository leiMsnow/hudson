<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 08/03/2018
 * Time: 18:06
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => 'code参数不合法'
    ];
}