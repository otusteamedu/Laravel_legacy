<?php

namespace App\Providers;

use App\Listeners\Cache\CacheHitEventListener;
use App\Listeners\Cache\Filter\ClearFilterCache;
use App\Listeners\LogAuthenticationAttempt;
use App\Services\Events\Models\Filter\FilterSaved;
use App\Services\Filters\Events\FilterCreated;
use App\Services\Filters\Listeners\FilterCreatedListener;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        Attempting::class => [
            LogAuthenticationAttempt::class
        ],
        FilterSaved::class => [
            ClearFilterCache::class
        ],
        CacheHit::class => [
            CacheHitEventListener::class,
        ],
        FilterCreated::class => [
            FilterCreatedListener::class
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
