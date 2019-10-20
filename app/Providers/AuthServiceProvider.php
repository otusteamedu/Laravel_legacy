<?php

namespace App\Providers;

use App\Models\User;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::after(function ($user, $ability, $result, $arguments) {
            /*
             * если проверки выше вернули результат, то вовзращаем его
             * @see \Illuminate\Contracts\Auth\Access\Gate::before()
             * @see \Illuminate\Contracts\Auth\Access\Gate::define()
             * @see \Illuminate\Contracts\Auth\Access\Gate::policy()
             */
            if (null !== $result) {
                return $result;
            }

            if ($user instanceof User) {
                return $user->hasPermission($ability);
            }

            return false;
        });
    }
}
