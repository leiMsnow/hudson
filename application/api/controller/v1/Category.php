<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 08/03/2018
 * Time: 11:17
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;


class Category
{

    public function getAllCategories()
    {
        $categories = CategoryModel::all([],'img');
        if ($categories->isEmpty()){
            throw new CategoryException();
        }

        return $categories;
    }
}