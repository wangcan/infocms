<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BrandController extends Controller
{
	use BrandTrait;

    public function home()
    {
		$datas = [
			'title' => 'ggggg', 
			'keywords' => 'key', 
			'description' => 'description',
			'view' => 'home',
		];
        return $this->customView('home', $datas);
    }

    public function detail()
    {
		$datas = [
			'title' => 'ggggg', 
			'keywords' => 'key', 
			'description' => 'description',
			'view' => 'detail',
		];
        return $this->customView('detail', $datas);
    }
}
