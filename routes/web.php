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
var_dump($currentHost);
foreach ($routes as $domain => $domainRoutes) {
    if ($currentHost !== false && $currentHost != $domain) {
        continue;
    }
    Route::domain(config('app.' . $currentHost . 'Domain'))->group(function () use ($domain, $domainRoutes) {
        foreach ($domainRoutes['routes'] as $route) {
            $domainRoute = $domainRoutes[$route] ?? [];

            $methods = $domainRoute['methods'] ?? ['GET'];
            $controller = $domainRoute['controller'] ?? $domain;
            $action = $domainRoute['action'] ?? $route;
            $action = empty($action) ? 'home' : $action;
            $name = $domainRoute['name'] ?? $controller . '.' . $action;
            echo serialize($methods) . '--' . $controller . '==' . $action . '===' . $name . "\n <br />";
            if ($methods === 'any') {
                Route::any('/' . $route, ucfirst($controller) . 'Controller@' . $action)->name($name);
            } else {
                Route::match($methods, '/' . $route, ucfirst($controller) . 'Controller@' . $action)->name($name);
            }
        }
    });
}



/*Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');
Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');
Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');*/
