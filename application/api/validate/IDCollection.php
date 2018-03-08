<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 07/03/2018
 * Time: 17:11
 */

namespace app\api\validate;


use function explode;

class IDCollection extends BaseValidate
{

    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数不合法,参数格式为：[ids=1,2,3]'
    ];

    public function checkIDs($value)
    {
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }

        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                return false;
            }
        }
        return true;
    }
}