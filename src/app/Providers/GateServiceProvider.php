<?php

namespace App\Providers;

use App\Models\Business;
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
            return isset($user->business);
        });

        // Доступ к редактированию своего салона
        Gate::define('accessMyBusinessPanel', function (User $user, Business $business) {
            return $business->user_id == $user->id;
        });

        // TODO: Починить
//        Gate::guessPolicyNamesUsing(function ($modelClass) {
//            return str_replace("\\Models\\", "\\Policies\\" , $modelClass) . 'Policy';
//        });
    }
}
