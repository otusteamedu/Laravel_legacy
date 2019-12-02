<?php

namespace App\Providers;

use App\Policies\OrderPolicy;
use App\Models\Orders\Order;
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
        'App\Model' => 'App\Policies\ModelPolicy',
        Order::class => OrderPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::define('edit-transport', function($user) {
            return $user->hasRole('admin');
        });

        Gate::define('add-order', function($user) {
            return $user->hasRole('client');
        });
    }
}
