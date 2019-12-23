<?php

namespace App\Providers;

use App\Models\Location;
use App\Models\Workout;
use App\Policies\LocationPolicy;
use App\Policies\WorkoutPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Location::class => LocationPolicy::class,
        Workout::class => WorkoutPolicy::class,
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
