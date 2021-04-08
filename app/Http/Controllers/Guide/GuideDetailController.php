<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuideDetailController extends Controller
{
	use GuideTrait;

    public function store()
    {
        return $this->customView('store');
    }

	public function shop()
	{
        return $this->customView('shop');
	}

	public function knowledge()
	{
        return $this->customView('knowledge');
	}

	public function human()
	{
		$datas = [
			'title' => '',
			'keywords' => '',
			'description' => '',
			'view' => 'human-detail',
		];
        return $this->customView('human', $datas);
	}

	public function info()
	{
        return $this->customView('info');
	}

	public function league()
	{
        return $this->customView('league');
	}
}
