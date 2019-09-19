<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\User;
use App\Policies\CountryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Country::class => CountryPolicy::class,
    ];

    public function register()
    {

    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//        Gate::define('countries.view', function (User $user) {
//            return $user->isAdmin();
//        });

//        Passport::routes();

    }
}
