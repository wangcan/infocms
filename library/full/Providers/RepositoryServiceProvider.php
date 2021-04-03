<?php

namespace Yeelight\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
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
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(base_path('vendor/prettus/l5-repository/src/resources/config/repository.php'), 'repository');

        $this->loadTranslationsFrom(base_path('vendor/prettus/l5-repository/src/resources/lang'), 'repository');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('Yeelight\Generators\Commands\RepositoryCommand');
        $this->commands('Yeelight\Generators\Commands\TransformerCommand');
        $this->commands('Yeelight\Generators\Commands\PresenterCommand');
        $this->commands('Yeelight\Generators\Commands\EntityCommand');
        $this->commands('Yeelight\Generators\Commands\ValidatorCommand');
        $this->commands('Yeelight\Generators\Commands\ControllerCommand');
        $this->commands('Yeelight\Generators\Commands\ApiControllerCommand');
        $this->commands('Yeelight\Generators\Commands\RequestCommand');
        $this->commands('Yeelight\Generators\Commands\BindingsCommand');
        $this->commands('Yeelight\Generators\Commands\CriteriaCommand');
        $this->commands('Yeelight\Generators\Commands\ViewsCommand');
        $this->commands('Yeelight\Generators\Commands\LangCommand');

        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminUserRepository::class, \Yeelight\Repositories\Eloquent\AdminUserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminRoleRepository::class, \Yeelight\Repositories\Eloquent\AdminRoleRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminPermissionRepository::class, \Yeelight\Repositories\Eloquent\AdminPermissionRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminMenuRepository::class, \Yeelight\Repositories\Eloquent\AdminMenuRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminOperationLogRepository::class, \Yeelight\Repositories\Eloquent\AdminOperationLogRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\UserRepository::class, \Yeelight\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\SocialiteUserRepository::class, \Yeelight\Repositories\Eloquent\SocialiteUserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\ProductModelRepository::class, \Yeelight\Repositories\Eloquent\ProductModelRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\ProductModelRepository::class, \Yeelight\Repositories\Eloquent\ProductModelRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
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

use Prettus\Repository\Providers\LumenRepositoryServiceProvider;

class RepositoryServiceProvider extends LumenRepositoryServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app->bind(\App\Contracts\Repositories\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\PostRepository::class, \App\Repositories\Eloquent\PostRepositoryEloquent::class);
    }
}
<?php

namespace Bosnadev\Repositories\Providers;

use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Bosnadev\Repositories\Console\Commands\MakeCriteriaCommand;
use Bosnadev\Repositories\Console\Commands\MakeRepositoryCommand;
use Bosnadev\Repositories\Console\Commands\Creators\CriteriaCreator;
use Bosnadev\Repositories\Console\Commands\Creators\RepositoryCreator;

/**
 * Class RepositoryProvider
 *
 * @package Bosnadev\Repositories\Providers
 */
class RepositoryProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config path.
        $config_path = __DIR__ . '/../../../config/repositories.php';

        // Publish config.
        $this->publishes(
            [$config_path => config_path('repositories.php')],
            'repositories'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register bindings.
        $this->registerBindings();

        // Register make repository command.
        $this->registerMakeRepositoryCommand();

        // Register make criteria command.
        $this->registerMakeCriteriaCommand();

        // Register commands
        $this->commands(['command.repository.make', 'command.criteria.make']);

        // Config path.
        $config_path = __DIR__ . '/../../../config/repositories.php';

        // Merge config.
        $this->mergeConfigFrom(
            $config_path,
            'repositories'
        );
    }

    /**
     * Register the bindings.
     */
    protected function registerBindings()
    {
        // FileSystem.
        $this->app->instance('FileSystem', new Filesystem());

        // Composer.
        $this->app->bind('Composer', function ($app)
        {
            return new Composer($app['FileSystem']);
        });

        // Repository creator.
        $this->app->singleton('RepositoryCreator', function ($app)
        {
            return new RepositoryCreator($app['FileSystem']);
        });

        // Criteria creator.
        $this->app->singleton('CriteriaCreator', function ($app)
        {
            return new CriteriaCreator($app['FileSystem']);
        });
    }

    /**
     * Register the make:repository command.
     */
    protected function registerMakeRepositoryCommand()
    {
        // Make repository command.
        $this->app['command.repository.make'] = $this->app->share(
            function($app)
            {
                return new MakeRepositoryCommand($app['RepositoryCreator'], $app['Composer']);
            }
        );
    }

    /**
     * Register the make:criteria command.
     */
    protected function registerMakeCriteriaCommand()
    {
        // Make criteria command.
        $this->app['command.criteria.make'] = $this->app->share(
            function($app)
            {
                return new MakeCriteriaCommand($app['CriteriaCreator'], $app['Composer']);
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.repository.make',
            'command.criteria.make'
        ];
    }
}
