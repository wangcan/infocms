<?php

namespace Larabase\Helpers;

use Illuminate\Support\Str;

/**
 * Class ResourceManager
 *
 * @category Larabase
 * @package Larabase\Helpers
 * @license https://opensource.org/licenses/MIT MIT
 */
class ResourceManager
{
    public static function getModel($code, $module = '')
    {
        $class = "App\Models\\";
        $class .= !empty($module) ? ucfirst($module) . "\\" : '';
        $class .= ucfirst($code);
        return new $class();
    }

    public static function getRouteParam($param)
    {
        $param = \Request::route($param);
        return $param;
    }

    public static function setRoute($route, $domain, $domainRoutes)
    {
        $domainRoute = $domainRoutes[$route] ?? [];
        $methods = $domainRoute['methods'] ?? ['GET'];
        $controller = $domainRoute['controller'] ?? $domain;
        $action = self::formatRouteAction($route, $domainRoute);
        $name = $domainRoute['name'] ?? $controller . '.' . $action;
        echo '/' . $route . '====' . serialize($methods) . '--' . $controller . '==' . $action . '===' . $name . "\n <br />";
        if ($methods === 'any') {
            \Route::any('/' . $route, ucfirst($controller) . 'Controller@' . $action)->name($name);
        } else {
            \Route::match($methods, '/' . $route, ucfirst($controller) . 'Controller@' . $action)->name($name);
        }
    }

    public static function formatRouteAction($route, $domainRoute)
    {
        $action = $domainRoute['action'] ?? $route;
        $action = empty($action) ? 'home' : $action;
        $strpos = strpos($action, '{');
        $action = $strpos ? substr($action, 0, $strpos) : $action;
        var_dump($action); echo '=================';
        $action = trim($action, '/');
        return Str::camel($action);
    }
}
