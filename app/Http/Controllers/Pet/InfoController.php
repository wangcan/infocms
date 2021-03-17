<?php

namespace App\Http\Controllers\Pet;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function home()
    {
        return $this->customView('infosort', ['view' => 'infohome']);
    }

    public function listinfo()
    {
        return $this->customView('infolist', ['view' => 'infolist']);
    }

    public function detail()
    {
        return $this->customView('cmsshow', ['view' => 'infodetail']);
    }
}
