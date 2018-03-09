<?php

namespace app\api\model;


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
        $products = self::where('category_id', $id)->select();
        return $products;
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getProductDetail($id)
    {

        $product = self::with([
            'imgs' => function ($query) {
                $query->with(['imgUrl'])->order('order', 'asc');
            }
        ])->with(['properties'])->find($id);

        return $product;
    }
}
