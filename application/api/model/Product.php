<?php

namespace app\api\model;

use think\Model;

class Product extends BaseModel
{
    protected $hidden = [
        'delete_time', 'update_time', 'pivot', 'create_time', 'img_id', 'from', 'category_id'
    ];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getMostRecent($count)
    {
        $product = self::limit($count)->order('create_time', 'desc')->select();
        return $product;
    }

    public static function getProductByCategoryID($id)
    {
        $products = self::where('category_id',$id)->select();
        return $products;
    }
}
