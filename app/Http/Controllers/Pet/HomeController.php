<?php

namespace App\Http\Controllers\Pet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function home()
    {
		$datas = [
			'title' => 'title',
			'keywords' => 'keywords',
			'description' => 'description',
			'view' => 'home',
		];
        return $this->customView('home', $datas);
    }

    public function specialList()
    {
        return $this->customView('speciallist');
    }

    public function specialDetail()
    {
        return $this->customView('specialshow');
    }
}
