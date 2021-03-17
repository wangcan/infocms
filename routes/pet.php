<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home.home');
Route::get('/speciallist', 'HomeController@specialList')->name('home.special-list');
Route::get('/specialshow-{id}', 'HomeController@specialDetail')->name('home.specialDetail');

Route::get('/pethome/{code?}', 'PetController@home')->name('pet.home');
Route::get('/petlist/{code?}', 'PetController@listinfo')->name('pet.list');
Route::get('/petshow-{id}', 'PetController@detail')->name('pet.detail');
Route::get('/infohome/{code?}', 'InfoController@home')->name('info.home');
Route::get('/infolist/{code?}', 'InfoController@listinfo')->name('info.list');
Route::get('/infoshow-{id}', 'InfoController@detail')->name('info.detail');

/*Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');
Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');
Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');*/
