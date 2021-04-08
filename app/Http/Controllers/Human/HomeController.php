<?php

namespace App\Http\Controllers\Human;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        return $this->customView('home');
    }

    public function listinfo()
    {
        return $this->customView('list');
    }

    public function detail()
    {
        return $this->customView('show');
    }
}
