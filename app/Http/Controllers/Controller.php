<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\FileViewFinder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Utils\AgentTool;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

	public function isMobile()
	{
		return AgentTool::isMobile();
	}

	protected function customView($view, $datas = [], $viewPath = null)
	{
		$viewPath = is_null($viewPath) ? $this->viewPath() : $viewPath;
		$view = $viewPath . '.' . $view;
		$viewPre = $this->viewPre();
		$datas = array_merge([
			'title' => 'title',
			'keywords' => 'keywords',
			'description' => 'description'
		], $datas);
		return view($view, ['datas' => $datas]);
	}

	protected function viewPre()
	{
		View::addLocation(app_path().'/views');
		$path = $this->isMobile() ? 'mobile' : 'pc';
		//$path = 'mobile';

        $paths = [resource_path('views') . '/' . $path];
		$finder =new FileViewFinder(App::make ('files'), $paths);
		View::setFinder ($finder);
	}
}
