<?php

namespace App\Http\Controllers\Human;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
	public function isMobile()
	{
		return null;
	}

	protected function viewPath()
	{
		return 'human';
	}
}
