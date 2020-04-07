<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\AuthorizationClass;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // -- COUNTY --
        Gate::define('create-country', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-country', $whoCan[$user->role]);
        });

        Gate::define('update-country', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-country', $whoCan[$user->role]);
        });

        Gate::define('delete-country', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-country', $whoCan[$user->role]);
        });

        // -- CITY --
        Gate::define('create-city', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-city', $whoCan[$user->role]);
        });

        Gate::define('update-city', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-city', $whoCan[$user->role]);
        });

        Gate::define('delete-country', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-country', $whoCan[$user->role]);
        });

        // -- TARIFFS --
        Gate::define('create-tariff', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-tariff', $whoCan[$user->role]);
        });

        Gate::define('update-tariff', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-tariff', $whoCan[$user->role]);
        });

        Gate::define('delete-tariff', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-tariff', $whoCan[$user->role]);
        });

        // -- SEGMENT --
        Gate::define('create-segment', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-segment', $whoCan[$user->role]);
        });

        Gate::define('update-segment', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-segment', $whoCan[$user->role]);
        });

        Gate::define('delete-segment', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-segment', $whoCan[$user->role]);
        });

        // -- USER --
        Gate::define('create-user', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-user', $whoCan[$user->role]);
        });

        Gate::define('update-user', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-user', $whoCan[$user->role]);
        });

        Gate::define('delete-user', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-user', $whoCan[$user->role]);
        });

        // -- CATEGORY --
        Gate::define('create-category', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-category', $whoCan[$user->role]);
        });

        Gate::define('update-category', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-category', $whoCan[$user->role]);
        });

        Gate::define('delete-category', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-category', $whoCan[$user->role]);
        });

        // -- PROJECT --
        Gate::define('create-project', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-project', $whoCan[$user->role]);
        });

        Gate::define('update-project', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-project', $whoCan[$user->role]);
        });

        Gate::define('delete-project', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-project', $whoCan[$user->role]);
        });

        // -- OFFER --
        Gate::define('create-offer', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('create-offer', $whoCan[$user->role]);
        });

        Gate::define('update-offer', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('update-offer', $whoCan[$user->role]);
        });

        Gate::define('delete-offer', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('delete-offer', $whoCan[$user->role]);
        });

        Gate::define('show-cms', function ($user) {

            $authorize = new AuthorizationClass();
            $whoCan = $authorize->getRoles();

            return in_array('show-cms', $whoCan[$user->role]);
        });

    }
}
