<?php

namespace App\Providers;

use App\Policies\Abilities;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Grammar;
use App\Policies\GrammarPolicy;
use App\Models\User;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       // 'App\Model' => 'App\Policies\ModelPolicy',
        Grammar::class => GrammarPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define(Abilities::VIEW, function ($user) {
            return $user->id == 1;
        });
        Gate::define(Abilities::UPDATE, function ($user, $grammar) {
            return ($user->id == $grammar->create_user_id||($user->id==1));
        });
        Passport::routes();
    }
}
