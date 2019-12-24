<?php

namespace App\Providers;

use App\Listeners\Cache\Location\ClearLocationCache;
use App\Listeners\Cache\Workout\ClearWorkoutCache;
use App\Services\Events\Models\Location\LocationDeleted;
use App\Services\Events\Models\Location\LocationSaved;
use App\Services\Events\Models\Workout\WorkoutDeleted;
use App\Services\Events\Models\Workout\WorkoutSaved;
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
    protected $listen = array(
        Registered::class => array(
            SendEmailVerificationNotification::class,
        ),
        WorkoutSaved::class => array(
            ClearWorkoutCache::class,
        ),
        WorkoutDeleted::class => array(
            ClearWorkoutCache::class,
        ),
        LocationSaved::class => array(
            ClearLocationCache::class,
        ),
        LocationDeleted::class => array(
            ClearLocationCache::class,
        ),
    );

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
