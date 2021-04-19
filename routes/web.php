<?php

use Illuminate\Support\Facades\Route;

//echo get_class(Route::domain(config('app.subjectDomain'))) . '---';exit();
Route::domain(config('app.subjectDomain'))->attribute('namespace', 'Guide')->group(function () {
//Route::group(['namespace' => 'Subject'], function () {
    Route::get('/', 'SubjectController@home')->name('home.home');
    Route::get('/human', 'SubjectListController@human')->name('subject.human');
    Route::get('/info', 'SubjectListController@info')->name('subject.info');
    Route::get('/knowledge', 'SubjectListController@knowledge')->name('subject.knowledge');
    Route::get('/league', 'SubjectListController@league')->name('subject.league');
    Route::get('/product', 'SubjectListController@product')->name('subject-list.product');
    Route::get('/shop', 'SubjectListController@shop')->name('subject-list.shop');
    Route::get('/store', 'SubjectListController@store')->name('subject-list.store');
});

Route::domain(config('app.brandDomain'))->attribute('namespace', 'Guide')->group(function () {
    Route::get('/', 'BrandController@home')->name('brand.home');
    Route::get('/detail', 'BrandController@detail')->name('brand.detail');
    Route::get('/product', 'BrandListController@product')->name('brand-list.product');
    Route::get('/shop', 'BrandListController@shop')->name('brand-list.shop');
    Route::get('/store', 'BrandListController@store')->name('brand-list.store');
});


Route::domain(config('app.petDomain'))->attribute('namespace', 'Pet')->group(function () {
    Route::get('/', 'HomeController@home')->name('home.home');
    Route::get('/speciallist', 'HomeController@specialList')->name('home.special-list');
    Route::get('/specialshow-{id}', 'HomeController@specialDetail')->name('home.specialDetail');
    
    Route::get('/pethome/{code?}', 'PetController@home')->name('pet.home');
    Route::get('/petlist/{code?}', 'PetController@listinfo')->name('pet.list');
    Route::get('/petshow-{id}', 'PetController@detail')->name('pet.detail');
    Route::get('/infohome/{code?}', 'InfoController@home')->name('info.home');
    Route::get('/infolist/{code?}', 'InfoController@listinfo')->name('info.list');
    Route::get('/infoshow-{id}', 'InfoController@detail')->name('info.detail');
});

Route::group(['namespace' => 'Guide'], function () {
    Route::get('/', 'GuideSingleController@home')->name('guide-single.home');
    Route::get('/vote', 'GuideSingleController@vote')->name('guide-single.vote');
    Route::get('/showstore-{id}', 'GuideDetailController@store')->name('guide-detail.store');
    Route::get('/showhuman-{id}', 'GuideDetailController@human')->name('guide-detail.human');
    Route::get('/showinfo-{id}', 'GuideDetailController@info')->name('guide-detail.info');
    Route::get('/showknowledge-{id}', 'GuideDetailController@knowledge')->name('guide-detail.knowledge');
    Route::get('/showleague-{id}', 'GuideDetailController@league')->name('guide-detail.league');
    Route::get('/showshop-{id}', 'GuideDetailController@shop')->name('guide-detail.shop');
});

Route::group(['namespace' => 'Human'], function () {
    Route::get('/', 'HomeController@home')->name('home.home');
    Route::get('/{code}', 'HomeController@view')->name('home.view');
});


Route::domain(config('app.cultureDomain'))->attribute('namespace', 'Culture')->group(function () {
    Route::get('/', 'HomeController@home')->name('home.home');
    Route::get('/list', 'HomeController@listinfo')->name('home.home');
    Route::get('/list/{code}', 'HomeController@listinfo')->name('home.home');
    Route::get('/list/{code}-{page}', 'HomeController@listinfo')->name('home.home');
    Route::get('/show-{id}', 'HomeController@detail')->name('home.show');
    
    Route::get('/test', 'HomeController@test')->name('home.test');
});

/*Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');
Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');
Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');*/
