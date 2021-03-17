<?php

use Illuminate\Support\Facades\Route;

Route::domain(config('app.subjectDomain'))->group(function () {
    Route::get('/', 'SubjectController@home')->name('home.home');
    Route::get('/human', 'SubjectListController@human')->name('subject.human');
    Route::get('/info', 'SubjectListController@info')->name('subject.info');
    Route::get('/knowledge', 'SubjectListController@knowledge')->name('subject.knowledge');
    Route::get('/league', 'SubjectListController@league')->name('subject.league');
    Route::get('/product', 'SubjectListController@product')->name('subject-list.product');
    Route::get('/shop', 'SubjectListController@shop')->name('subject-list.shop');
    Route::get('/store', 'SubjectListController@store')->name('subject-list.store');
});

Route::domain(config('app.brandDomain'))->group(function () {
    Route::get('/', 'BrandController@home')->name('brand.home');
    Route::get('/detail', 'BrandController@detail')->name('brand.detail');
    Route::get('/product', 'BrandListController@product')->name('brand-list.product');
    Route::get('/shop', 'BrandListController@shop')->name('brand-list.shop');
    Route::get('/store', 'BrandListController@store')->name('brand-list.store');
});

Route::get('/', 'GuideSingleController@home')->name('guide-single.home');
Route::get('/vote', 'GuideSingleController@vote')->name('guide-single.vote');
Route::get('/showstore-{id}', 'GuideDetailController@store')->name('guide-detail.store');
Route::get('/showhuman-{id}', 'GuideDetailController@human')->name('guide-detail.human');
Route::get('/showinfo-{id}', 'GuideDetailController@info')->name('guide-detail.info');
Route::get('/showknowledge-{id}', 'GuideDetailController@knowledge')->name('guide-detail.knowledge');
Route::get('/showleague-{id}', 'GuideDetailController@league')->name('guide-detail.league');
Route::get('/showshop-{id}', 'GuideDetailController@shop')->name('guide-detail.shop');
