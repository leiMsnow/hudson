<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 07/03/2018
 * Time: 18:39
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissingProductException;

class Product
{

    public function getRecent($count = 16)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if (!$products)
            throw  new MissingProductException();
        $products = $products->hidden(['summary']);
        return $products;
    }

    public function getAllInCategory($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductByCategoryID($id);
        if ($products->isEmpty()) {
            throw new MissingProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }

    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $product = ProductModel::getProductDetail($id);
        if (!$product) {
            throw new MissingProductException();
        }

        return $product;
    }
}