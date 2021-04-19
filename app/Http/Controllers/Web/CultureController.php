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
			'pet' => ['/', '/info-show-1', '/info-list', '/info-home', '/pet-home', '/pet-list', '/pet-show-1', '/special-list', '/special-show-1'],
			'subject' => ['/', '/human', '/info', '/knowledge', '/league', '/product', '/shop', '/store'],
			'brand' => ['/', '/detail', '/product', '/shop', '/store'],
			'guide' => ['/', '/show-human-1', '/show-info-1', '/show-knowledge-1', '/show-league-1', '/show-shop-1', '/show-store-1', '/vote'],
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
