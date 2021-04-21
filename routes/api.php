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
    'middleware' => 'api',
    //'middleware' => 'cors',
];

Route::group($authAttributes, function() {
    Route::post('login', 'AuthController@login');//->name('login'); // 用户名、密码登录接口
    Route::post('refresh', 'AuthController@refresh');
    Route::get('register', 'RegisterController@register');
});

$authAttributes['middleware'] = ['api', 'auth:api'];

Route::group($authAttributes, function() {
    Route::get('myinfo', 'UserController@myinfo');
    Route::post('logout', 'UserController@logout'); // 注销当前用户
});

$infocmsAttributes = [
    'prefix' => 'infocms',
    'namespace' => 'Infocms',
    //'middleware' => 'cors',
    //'middleware' => 'auth:api',
];
Route::group($infocmsAttributes, function() {
    Route::resource('pets', PetController::class);
});

/*$saleNoauthAttributes = [
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

});*/
