<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home.home');
Route::get('/list', 'HomeController@listinfo')->name('home.home');
Route::get('/list/{code}', 'HomeController@listinfo')->name('home.home');
Route::get('/list/{code}-{page}', 'HomeController@listinfo')->name('home.home');
Route::get('/show-{id}', 'HomeController@detail')->name('home.show');

Route::get('/test', 'HomeController@test')->name('home.test');
