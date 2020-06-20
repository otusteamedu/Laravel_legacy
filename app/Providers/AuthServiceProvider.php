<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Country;
use App\Models\Event;
use App\Models\Language;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\CountryPolicy;
use App\Policies\EventPolicy;
use App\Policies\LanguagePolicy;
use App\Policies\NewsPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Country::class => CountryPolicy::class,
        Event::class => EventPolicy::class,
        Language::class => LanguagePolicy::class,
        News::class => NewsPolicy::class,
        Role::class => RolePolicy::class,
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
        $this->registerGates();

        Passport::routes();
    }

    public function registerGates() {
        Gate::define('admin-section-available', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        Gate::define('logs-section-available', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
    }
}
