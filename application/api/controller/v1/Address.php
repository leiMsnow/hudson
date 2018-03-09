<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 09/03/2018
 * Time: 15:34
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\AddressNew;

use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\message\SuccessMessage;
use app\lib\exception\UserException;
use function input;

class Address extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];

    protected function checkPrimaryScope()
    {
        $scope = TokenService::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {

        }
}

public
function createOrUpdateAddress()
{
    $validate = new AddressNew();
    $validate->goCheck();

    $uid = TokenService::getCurrentUID();
    $user = UserModel::get($uid);

    if (!$user) {
        throw new UserException();
    }

    $dataArray = $validate->getDataByRule(input('post.'));

    $userAddress = $user->address;

    if (!$userAddress) {
        $user->address()->save($dataArray);
    } else {
        $user->address->save($dataArray);
    }

    return json(new SuccessMessage(), 201);
}

}