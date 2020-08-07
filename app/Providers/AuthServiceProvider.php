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
use Laravel\Passport\Passport;

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

        $this->gates();

        $this->laravelPassport();
    }

    private function laravelPassport(): void
    {
        Passport::routes();

        Passport::tokensCan([
            'userinfo' => 'Get user info',
            'messages' => 'Access messages',
        ]);
    }

    private function gates(): void
    {
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

        Gate::define(Ability::SEND, function (User $user, Post $post): bool {
            if (!is_null($post->published_at)) {
                return false;
            }

            return $user->isAdmin() || $user->id === $post->user_id;
        });
    }
}
