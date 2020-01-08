<?php

namespace App\Providers;

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
        'App\Models\Movie' => 'App\Policies\MoviePolicy',
        'App\Models\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-perms', function ($user) {
            /** @var \App\Models\User $user */
            return $user->isRoot();
        });

        Gate::define('edit-perms', function ($user) {
            /** @var \App\Models\User $user */
            return $user->isRoot();
        });
    }
}
