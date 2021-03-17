<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubjectController extends Controller
{
	use SubjectTrait;

    public function home()
    {
        return $this->customView('home');
    }
}
