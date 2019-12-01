<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\User;
use App\Policies\CountryPolicy;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class,
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

        Passport::routes();
        Passport::enableImplicitGrant();


        Passport::tokensCan([
            'manage-countries' => 'Manage countries scope',
            'read-only-country' => 'Read only country scope',
            'manage-cities' => 'Manage countries scope',
            'read-only-city' => 'Read only city scope',
        ]);
    }
}
