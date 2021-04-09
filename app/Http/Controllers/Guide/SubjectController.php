<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubjectController extends Controller
{
	use SubjectTrait;

    public function home()
    {
		$datas = [
			'title' => 'hhhh', 
			'keywords' => 'key', 
			'description' => 'description',
			'view' => 'home',
		];
        return $this->customView('home', $datas);
    }
}
