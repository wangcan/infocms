<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class CultureController extends Controller
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

	public function test()
	{
		$str = '';
		$domains = [
			'culture' => 'http://culture.91zuiai.com', 
			'pet' => 'http://pet.91zuiai.com', 
            'subject' => 'http://subject-test.91zuiai.com',
            'brand' => 'http://brand-test.91zuiai.com',
			'guide' => 'http://guide.91zuiai.com',
            'human' => 'http://human-test.91zuiai.com',
		];

		$routes = [
			'culture' => ['/', '/list', '/show-1'],
			'pet' => ['/', '/infoshow-1', '/infolist', '/infohome', '/pethome', '/petlist', '/petshow-1', '/speciallist', '/specialshow-1'],
			'subject' => ['/', '/human', '/info', '/knowledge', '/league', '/product', '/shop', '/store'],
			'brand' => ['/', '/detail', '/product', '/shop', '/store'],
			'guide' => ['/', '/showhuman-1', '/showinfo-1', '/showknowledge-1', '/showleague-1', '/showshop-1', '/showstore-1', '/vote'],
			'human' => ['/', '/404', '/about', '/blog', '/contact', '/elements', '/gallery', '/home_alternative', '/page_alternative', '/portfolio', '/portfolio_item', '/portfolio_item_2', '/register', '/services', '/single_post', '/resume'],
		];

		foreach (['culture', 'pet', 'subject', 'brand', 'guide', 'human'] as $elem) {
			$domain = $domains[$elem];
			foreach ($routes[$elem] as $route) {
				$url = $domain . $route;
				$str .= "<a href='{$url}' target='_blank'>{$url}</a><br />";
			}
		}
		echo $str;
	}

	protected function viewPath()
	{
		return 'culture';
	}
}
