<?php

namespace Larabase\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Yeelight\Traits\AuthUserHelpers;

/**
 * Class Controller
 *
 * @category Larabase
 * @package Larabase\Http\Controllers
 * @license https://opensource.org/licenses/MIT MIT
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use AuthUserHelpers;
}
