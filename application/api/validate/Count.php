<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 07/03/2018
 * Time: 18:41
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,30'
    ];

}