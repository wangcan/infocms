<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class PetController extends Controller
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

    public function infoHome()
    {
        return $this->customView('infosort', ['view' => 'infohome']);
    }

    public function infoList()
    {
        return $this->customView('infolist', ['view' => 'infolist']);
    }

    public function infoShow()
    {
        return $this->customView('cmsshow', ['view' => 'infodetail']);
    }

    public function petHome()
    {
        return $this->customView('home', ['view' => 'pethome']);
    }

    public function petList()
    {
        return $this->customView('petlist', ['view' => 'petlist']);
    }

    public function petShow()
    {
        return $this->customView('petshow', ['view' => 'petdetail']);
    }

	protected function viewPath()
	{
		return 'petcms';
	}
}
