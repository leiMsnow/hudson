<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 04/03/2018
 * Time: 19:51
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();

        $result = $this->check($params);
        if (!$result) {
            $e = new ParameterException([
                'msg' => $this->error,
//                'code' => 400,
//                'errorCode' => 10002
            ]);
//            $e->msg = $this->error;
//            $e->errorCode = 10002;
            throw $e;
        } else {
            return true;
        }
    }

}