<?php

namespace App\Http\Controllers\Human;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        return $this->customView('home');
    }

    public function view($code)
    {
        return $this->customView($code);
    }

    public function detail()
    {
        return $this->customView('show');
    }

    public function resume()
    {
        return $this->customView('resume');
    }
}
