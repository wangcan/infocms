<?php

namespace App\Http\Controllers\Web;

class BrandController extends Controller
{
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

	protected function viewPath()
	{
		return 'brand';
	}
}
