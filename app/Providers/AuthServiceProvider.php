<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\Abilities;
use App\Policies\UserPolicy;
use Exception;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Админу всё разрешено
        Gate::before(function($user) {
            $result = false;
            if($user->level == User::LEVEL_ADMIN)
            {
                $result = true;
            }
            return $result;
        });

        // Из-за наличия Gate::before этот метод уже не актуален, но пусть будет
        Gate::define(Abilities::IS_ADMIN,function(User $user)
        {
            $result = $user->level == User::LEVEL_ADMIN ? true:false;
            return $result;
        });

    }
}
