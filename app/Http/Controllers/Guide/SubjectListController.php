<?php

namespace App\Http\Controllers\Guide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubjectListController extends Controller
{
	use SubjectTrait;

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
        return $this->customView('human');
	}

	public function info()
	{
        return $this->customView('info');
	}

	public function product()
	{
        return $this->customView('product');
	}

	public function league()
	{
        return $this->customView('league');
	}
}
