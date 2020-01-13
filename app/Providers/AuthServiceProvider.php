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
        // 'App\Model' => 'App\Policies\ModelPolicy',
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

        /* Gate::before(function($user) {
            $result = false;
            if($user->level === User::LEVEL_ADMIN)
            {
                $result = true;
            }
            return $result;
        });*/

        Gate::define(Abilities::VIEW,function($user)
        {
            // Оказывается, что первый параметр - $user это всегда текущий authenticated user!!!
            // Соот-но условие
            // auth()->user()->id === $user->id
            // не работает! Результат будет всегда true, ведь
            // auth()->user() === $user
            // return auth()->user()->id === $user->id;
            return true;
        });
    }
}
