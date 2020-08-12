<?php

namespace App\Providers;

use App\Listeners\Cache\CacheHitEventListener;
use App\Listeners\Cache\Film\ClearFilmSaveCache;
use App\Listeners\Cache\Film\ClearFilmUpdateCache;
use App\Listeners\LogAuthenticated;
use App\Listeners\LogAuthenticationAttempt;
use App\Listeners\LogFailedLogin;
use App\Listeners\LogLockout;
use App\Listeners\LogRegisteredUser;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Services\Events\Models\Film\FilmSaved;
use App\Services\Events\Models\Film\FilmUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Cache\Events\CacheHit;

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
        Attempting::class => [
            LogAuthenticationAttempt::class
        ],
        Authenticated::class => [
            LogAuthenticated::class
        ],
        Login::class => [
            LogSuccessfulLogin::class
        ],

        Failed::class => [
            LogFailedLogin::class
        ],

        Logout::class => [
            LogSuccessfulLogout::class
        ],

        Lockout::class => [
            LogLockout::class
        ],
        
        FilmSaved::class => [
            ClearFilmSaveCache::class,
        ],

        FilmUpdated::class => [
            ClearFilmUpdateCache::class
        ],

        CacheHit::class => [
            CacheHitEventListener::class,
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