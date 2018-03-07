<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    protected function prefixImgUrl($value, $data)
    {
        $url = $value;
        if ($data['from'] == 1) {
            $url = config('settings.img_prefix') . $value;
        }

        return $url;
    }
}
