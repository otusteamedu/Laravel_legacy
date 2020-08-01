<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class GateServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Доступ к админке
        Gate::define('accessAdminPanel', function (User $user) {
            return $user->role->name == "admin";
        });

        // Доступ к панели управления салоном
        Gate::define('accessBusinessPanel', function (User $user) {
            return $user->business()->count();
        });
    }
}
