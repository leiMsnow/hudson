<?php

namespace app\api\controller\v1;

use app\api\validate\IDCollection;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissingThemeException;
use function explode;
use think\Controller;
use app\api\model\Theme as ThemeModel;

class Theme extends Controller
{
    /**
     * @param string $ids /theme?ids=1,2,3
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')->select($ids);
        if (!$result) {
            throw new MissingThemeException();
        }

        return $result;
    }

    /**
     * @param $id /theme/:id
     */
    public function getComplexOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if (!$theme) {
            throw new MissingThemeException();
        }
        return $theme;
    }
}
