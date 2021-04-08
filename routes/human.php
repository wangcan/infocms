<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home.home');
Route::get('/{code}', 'HomeController@view')->name('home.view');

