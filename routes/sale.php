<?php

use Illuminate\Http\Request;

$userAttributes = [
    'prefix' => '',
    'namespace' => 'Auth',
    //'middleware' => 'cors',
];
Route::group($userAttributes, function() {
    Route::post('login', 'AuthController@login');//->name('login'); // 用户名、密码登录接口
    Route::get('myinfo', 'AuthController@myinfo');
    Route::post('logout', 'AuthController@logout'); // 注销当前用户
});

$saleNoauthAttributes = [
    'prefix' => '',
    'namespace' => 'Sale',
    //'middleware' => 'cors',
    //'middleware' => 'auth:api',
];
Route::group($saleNoauthAttributes, function() {
});

$saleAttributes = [
    'prefix' => '',
    'namespace' => 'Sale',
    //'middleware' => 'cors',
//    'middleware' => 'auth:api',
    'middleware' => ['auth:api','admin.log']
];

Route::group($saleAttributes, function() {
    Route::get('test', 'SalePeopleController@testUser'); // 销售列表

    Route::get('sale-peoples', 'SalePeopleController@index'); // 销售列表
    Route::get('sale-groups', 'SalePeopleController@group'); // 销售组
    Route::get('sale-notice', 'SalePeopleController@notice'); // 通知销售客户最新动态
    Route::get('sale-rnotice', 'SalePeopleController@recordNotice'); // 通知销售客户最新动态
    Route::post('upload_qrcode', 'SaleManyserviceController@uploadQrcode'); // 上传文件
    Route::get('sale-manyservices', 'SaleManyserviceController@index'); // 记录课程学习进度
    Route::get('sale-manyservice-tlists', 'SaleManyserviceController@tlist'); // 客户组二维码
    Route::get('sale-manyservice-wechats', 'SaleManyserviceController@wechat'); // 每日微信统计
    Route::post('saleman-wechat/record', 'SalemanWechatController@record'); // 添加/更新每日微信数
    Route::post('sale-manyservices/store', 'SaleManyserviceController@store'); // 添加销售二维码
    Route::post('sale-manyservices/update', 'SaleManyserviceController@update'); // 编辑销售二维码
    Route::post('sale-manyservices/sdelete', 'SaleManyserviceController@softDelete'); // 删除客服组-二维码
    Route::post('sale-manyservices/copy', 'SaleManyserviceController@enableData'); // 复制销售二维码
    Route::get('sale-manyservice-wdownload', 'SaleManyserviceController@download'); // 每日微信统计

    Route::get('sale-serviceteam/index', 'SaleServiceteamController@index'); // 客服组列表

    Route::get('saleman-customers', 'SalemanCustomerController@index'); // 我的线索
    //Route::get('sale-customer-trycourse', 'SalemanCustomerController@trycourse'); // 为线索开通体验课
    Route::post('sale-customer-trycourse', 'SalemanCustomerController@trycourse'); // 为线索开通体验课
    Route::post('sale-customer-chance', 'SalemanCustomerController@chance'); // 设置线索为机会
    Route::post('sale-customer-update', 'SalemanCustomerController@update'); // 编辑线索信息
    Route::get('saleman-clists', 'SalemanCustomerController@listinfo'); // 我的机会
    Route::get('saleman-buyers', 'SalemanBuyerController@index'); // 我的成单客户

    Route::get('saleman-callbacks', 'SalemanCallbackController@index'); // 我的成单客户
    Route::post('saleman-callbacks/store', 'SalemanCallbackController@store'); // 添加跟进记录
    Route::get('sale-orders', 'SaleOrderController@index'); // 我的销售订单
    Route::get('sale-ranks', 'SaleOrderController@rank'); // 销售榜单
    Route::get('sale-courses', 'SaleOrderController@course'); // 销售相关课程键值对

    Route::get('order-courses', 'OrderCourseController@attention'); // 销售关注的作品
    Route::get('homework-callbacks', 'HomeworkSubmitController@attention'); // 销售关注的课程

    Route::get('dispatch-saleman', 'SaleManyserviceController@dispatchSaleman'); // 分配销售二维码
});
