<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuideSingleController extends Controller
{
	use GuideTrait;

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

    public function vote()
    {
		$datas = [
			'title' => 'hhhh', 
			'keywords' => 'key', 
			'description' => 'description',
			'view' => 'vote',
		];
        return $this->customView('vote', $datas);
    }
}
