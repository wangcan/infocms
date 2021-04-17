<?php

namespace Larabase\Helpers;

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
}
