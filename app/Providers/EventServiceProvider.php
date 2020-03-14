<?php

namespace App\Providers;

use App\Listeners\Cache\User\ClearUserCache;
use App\Services\Events\Models\User\UserCreated;
use App\Services\Events\Models\User\UserDeleted;
use App\Services\Events\Models\User\UserUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\LogRegisteredUser;

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
            LogRegisteredUser::class,
        ],
        /*
         * Добавил своих слушателей
         */
        UserCreated::class => [ ClearUserCache::class   ],
        UserUpdated::class => [ ClearUserCache::class   ],
        UserDeleted::class => [ ClearUserCache::class   ],
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
