<?php

namespace App\Providers;

use App\Events\MovieEvent;
use App\Forget\MovieCache;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        ]
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
        Event::listen(MovieEvent::class, function(MovieEvent $event)
        {
            // dd($event->getMovie()->actors()->pluck('actor_id'));
            // Обработка события...
            $forgetKeys = (new MovieCache($event))->getForgetKeys();
            if(!empty($forgetKeys))
                call_user_func_array([app('cache'), 'forget'], $forgetKeys);
        });
    }
}
