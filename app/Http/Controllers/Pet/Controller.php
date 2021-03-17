<?php

namespace App\Http\Controllers\Pet;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{

	protected function viewPath()
	{
		return 'petcms';
	}
}
