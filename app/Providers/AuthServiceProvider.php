<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Post;
use App\Models\Student;
use App\Models\User;
use App\Policies\GroupPolicy;
use App\Policies\PostPolicy;
use App\Policies\StudentPolicy;
use App\Services\Helpers\Ability;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Group::class => GroupPolicy::class,
        Student::class => StudentPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, string $ability): ?bool {
            if ($user->isAdmin()) {
                return true;
            }

            return null;
        });

        Gate::define(Ability::CREATE_TEACHER, function (User $user): bool {
            return $user->isMethodist();
        });

        Gate::define(Ability::UPDATE_TEACHER, function (User $user): bool {
            return $user->isMethodist();
        });

        Gate::define(Ability::DELETE_TEACHER, function (User $user): bool {
            return $user->isMethodist();
        });

        Gate::define(Ability::CHANGE_SETTINGS, function (User $user): bool {
            return $user->isAdmin();
        });
    }
}
