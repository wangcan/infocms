<?php

namespace App\Http\Controllers\Web;

class GuideController extends Controller
{
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

    public function showStore()
    {
		$datas = [
			'title' => '',
			'keywords' => '',
			'description' => '',
			'view' => 'store',
		];
        return $this->customView('store', $datas);
    }

	public function showShop()
	{
		$datas = [
			'title' => '',
			'keywords' => '',
			'description' => '',
			'view' => 'shop',
		];
        return $this->customView('shop', $datas);
	}

	public function showKnowledge()
	{
		$datas = [
			'title' => '',
			'keywords' => '',
			'description' => '',
			'view' => 'knowledge',
		];
        return $this->customView('knowledge', $datas);
	}

	public function showHuman()
	{
		$datas = [
			'title' => '',
			'keywords' => '',
			'description' => '',
			'view' => 'human',
		];
        return $this->customView('human', $datas);
	}

	public function showInfo()
	{
		$datas = [
			'title' => '',
			'keywords' => '',
			'description' => '',
			'view' => 'info',
		];
        return $this->customView('info', $datas);
	}

	public function showLeague()
	{
		$datas = [
			'title' => '',
			'keywords' => '',
			'description' => '',
			'view' => 'league',
		];
        return $this->customView('league', $datas);
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

	protected function viewPath()
	{
		return 'guide';
	}
}
