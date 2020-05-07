<?php

namespace App\Providers;

use App\Services\Users\Events\UserRegistered;
use App\Services\Users\Listeners\UserRegisteredListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\LogRegisteredUser;
use App\Listeners\LogAuthenticationAttempt;
use App\Listeners\LogAuthenticated;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogFailedLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Listeners\LogLockout;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Failed;

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

        UserRegistered::class => [
            UserRegisteredListener::class
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
