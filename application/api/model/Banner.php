<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 04/03/2018
 * Time: 21:37
 */

namespace app\api\model;


class Banner extends BaseModel
{
    protected $hidden = ['update_time', 'delete_time'];

    public function items(){
        return $this->hasMany('BannerItem', 'banner_id','id');
    }

    protected $table = 'banner';
    public static function getBannerByID($id)
    {
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;
    }

}