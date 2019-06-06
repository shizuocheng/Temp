<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//];

use think\Route;
//Route::rule('Expression of Route','aderess of Route','Type of Request','parameter of Route','rule of Route');
//rule's all  possible situations Get,Post,Put ,Delete ,*  *express all request can do it ;


Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

Route::post('api/:version/token/user','api/:version.Token/getToken');

Route::get('api/:version/product/:id','api/:version.Product/getOne','',['id'=>'\d+']);
Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');
Route::get('api/:version/address', 'api/:version.Address/getUserAddress');

Route::get('api/:version/order/paginate', 'api/:version.Order/get');

//Route::get('api/:version/order/paginat', 'api/:version.Order/getSummary');

Route::post('api/:version/order','api/:version.Order/placeOrder');
Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

Route::get('api/:version/product/recent','api/:version.Product/getRecent');

Route::get('api/:version/category/all','api/:version.Category/getAllCategories');

Route::get('api/:version/product/by_category','api/:version.Product/getAllInCategory');

Route::get('api/:version/order/delivery', 'api/:version.Order/delivery11');

Route::post('api/:version/pay/pre_order','api/:version.Pay/getPreOrder');

Route::post('api/:version/pay/notify','api/:version.Pay/receiveNotify');


Route::get('api/:version/order/by_user','api/:version.Order/getSummaryByUser');

Route::get('api/:version/order/:id', 'api/:version.Order/getDetail',[], ['id'=>'\d+']);

Route::post('api/:version/token/verify', 'api/:version.Token/verifyToken');

Route::post('api/:version/token/app', 'api/:version.Token/getAppToken');

//Route::put('api/:version/order/delivery', 'api/:version.Order/delivery');


