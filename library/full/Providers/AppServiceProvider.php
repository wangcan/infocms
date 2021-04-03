<?php

namespace Yeelight\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

/**
 * Class AppServiceProvider
 *
 * @category Yeelight
 *
 * @package Yeelight\Providers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'backend.partials.sidebar', 'Yeelight\Composers\BackendMenuComposer'
        );
        Paginator::useBootstrap();
        $this->registerObservers(); // 注册观察者
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function registerObservers(): void
    {
        User::observe(UserObserver::class);
    }
}
