<?php

use Illuminate\Support\Facades\Route;

$routes = [
    'subject' => [
        'routes' => ['', 'human', 'info', 'knowledge', 'product', 'shop', 'store', 'league'],
    ],
    'brand' => [
        'routes' => ['', 'detail', 'product', 'product', 'shop', 'store'],
    ],
    'pet' => [
        'routes' => ['', 'special-list', 'special-show-{id}', 'pet-home/{code?}', 'pet-list/{code?}', 'pet-show-{id}', 'info-home/{code?}', 'info-list/{code?}', 'info-show-{id}'],
    ],
    'guide' => [
        'routes' => ['', 'vote', 'show-store-{id}', 'show-knowledge-{id}', 'show-shop-{id}', 'show-league-{id}', 'show-human-{id}', 'show-info-{id}'],
    ],
    'human' => [
        'routes' => ['', '{code}'],
        '{code}' => ['action' => 'view'],
    ],
    'culture' => [
        'routes' => ['', 'list', 'list/{code}', 'list/{code}-{page}', 'show-{id}', 'test'],
    ],
];
$currentHost = false;
$currentHost = $_SERVER['HTTP_HOST'] ?? false;
if ($currentHost) {
    $siteCode = explode('.', $currentHost)[0];
    $siteCode = explode('-', $siteCode)[0];
    $currentHost = in_array($siteCode, array_keys($routes)) ? $siteCode : false;
}
//var_dump($currentHost);
foreach ($routes as $domain => $domainRoutes) {
    //if ($currentHost !== false && $currentHost != $domain) {
    if ($currentHost != $domain) {
        continue;
    }
    Route::domain(config('app.' . $currentHost . 'Domain'))->group(function () use ($domain, $domainRoutes) {
        foreach ($domainRoutes['routes'] as $route) {
            ResourceManager::setRoute($route, $domain, $domainRoutes);
        }
    });
}

/*Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');
Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');
Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');*/
