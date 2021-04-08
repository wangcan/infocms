<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BrandListController extends Controller
{
	use BrandTrait;

    public function store()
    {
		$datas = [
			'title' => 'ggggg', 
			'keywords' => 'key', 
			'description' => 'description',
			'view' => 'store',
		];
        return $this->customView('store', $datas);
    }

	public function shop()
	{
		$datas = [
			'title' => 'ggggg', 
			'keywords' => 'key', 
			'description' => 'description',
			'view' => 'shop',
		];
        return $this->customView('shop', $datas);
	}

	public function product()
	{
		$datas = [
			'title' => 'ggggg', 
			'keywords' => 'key', 
			'description' => 'description',
			'view' => 'product',
		];
        return $this->customView('product', $datas);
	}
}
