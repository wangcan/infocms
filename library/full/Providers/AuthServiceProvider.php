<?php

namespace Yeelight\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

/**
 * Class AuthServiceProvider
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
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Yeelight\Models' => 'Yeelight\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // Token Lifetimes
//        Passport::tokensExpireIn(Carbon::now()->addDays(15));

        // Refresh Token Lifetimes
//        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        // Pruning Revoked Tokens
//        Passport::pruneRevokedTokens();

        // Token Scopes
//        Passport::tokensCan([
//            'place-orders' => 'Place orders',
//            'check-status' => 'Check order status',
//        ]);
    }
}
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Media' => 'App\Policies\MediaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
<?php

/*
 * This file is part of the Jiannei/lumen-api-starter.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Providers;

use App\Repositories\Enums\PermissionEnum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Boot the authentication services for the application.
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        /*$this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });*/

        Gate::before(PermissionEnum::gateBeforeCallback());

        $this->app['auth']->provider('custom', function ($app, array $config) {
            return new EloquentUserProvider($app['hash'], $config['model']);
        });
    }
}
