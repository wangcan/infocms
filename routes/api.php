<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$authAttributes = [
    'prefix' => '',
    //'namespace' => 'auth:api',
    'namespace' => 'Auth',
    //'middleware' => 'cors',
];

Route::group($authAttributes, function() {
    Route::post('login', 'AuthController@login');//->name('login'); // 用户名、密码登录接口
    Route::get('myinfo', 'AuthController@myinfo');
    Route::post('logout', 'AuthController@logout'); // 注销当前用户
});


$userAttributes = [
    'prefix' => '',
    'namespace' => 'Auth',
    //'middleware' => 'cors',
];
Route::group($userAttributes, function() {
    Route::post('login', 'AuthController@login');//->name('login'); // 用户名、密码登录接口
    Route::put('signin', 'AuthController@login');//->name('login'); // 用户名、密码登录接口
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
    //'middleware' => ['auth:api','admin.log']
];

Route::group($saleAttributes, function() {
    Route::get('test', 'SalePeopleController@testUser'); // 销售列表

});
