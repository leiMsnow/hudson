<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

Route::group('api/:version/theme', function(){
    Route::get('/','api/:version.Theme/getSimpleList');
    Route::get('/:id','api/:version.Theme/getComplexOne');

});

Route::group('api/:version/product', function(){
    Route::get('/byCategory','api/:version.Product/getAllInCategory');
    Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
    Route::get('/recent','api/:version.Product/getRecent');
});

Route::get('api/:version/category/all','api/:version.Category/getAllCategories');

Route::post('api/:version/token/user','api/:version.Token/getToken');

Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');

return [

];
