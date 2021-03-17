<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuideSingleController extends Controller
{
	use GuideTrait;

    public function home()
    {
        return $this->customView('home');
    }

    public function vote()
    {
        return $this->customView('vote');
    }
}
