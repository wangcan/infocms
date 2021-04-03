<?php

namespace Yeelight\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
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
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Yeelight\Events\Event' => [
            'Yeelight\Listeners\EventListener',
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'Yeelight\Listeners\Auth\RevokeOldTokens',
        ],
        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'Yeelight\Listeners\Auth\PruneOldTokens',
        ],
        /*Registered::class => [
            SendEmailVerificationNotification::class,
        ],*/
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
<?php
namespace Prettus\Repository\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Prettus\Repository\Events\RepositoryEntityCreated' => [
            'Prettus\Repository\Listeners\CleanCacheRepository'
        ],
        'Prettus\Repository\Events\RepositoryEntityUpdated' => [
            'Prettus\Repository\Listeners\CleanCacheRepository'
        ],
        'Prettus\Repository\Events\RepositoryEntityDeleted' => [
            'Prettus\Repository\Listeners\CleanCacheRepository'
        ]
    ];

    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        $events = app('events');

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}
