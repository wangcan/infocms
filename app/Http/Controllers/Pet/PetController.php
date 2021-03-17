<?php

namespace App\Http\Controllers\Pet;

use Illuminate\Http\Request;

class PetController extends Controller
{
    public function home()
    {
        return $this->customView('home', ['view' => 'pethome']);
    }

    public function listinfo()
    {
        return $this->customView('petlist', ['view' => 'petlist']);
    }

    public function detail()
    {
        return $this->customView('petshow', ['view' => 'petdetail']);
    }
}
