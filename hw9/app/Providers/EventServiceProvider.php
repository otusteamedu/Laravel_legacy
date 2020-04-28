<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\Cache\User\ClearUserCache;
use App\Listeners\Cache\Task\ClearTaskCache;
use App\Services\Events\Models\User\UserDeleted;
use App\Services\Events\Models\User\UserSaved;
use App\Services\Events\Models\Task\TaskDeleted;
use App\Services\Events\Models\Task\TaskSaved;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserSaved::class => [
            ClearUserCache::class,
        ],
        UserDeleted::class => [
            ClearUserCache::class,
        ],
        TaskSaved::class => [
            ClearUserCache::class,
        ],
        TaskDeleted::class => [
            ClearUserCache::class,
        ],
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
