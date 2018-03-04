<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 04/03/2018
 * Time: 16:22
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use think\Exception;

class Banner
{

    /**
     * 获取指定Id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的Id
     */
    public function getBanner($id)
    {

        (new IDMustBePositiveInt)->goCheck();

        $banner = BannerModel::getBannerByID($id);

        return $banner;

    }

}