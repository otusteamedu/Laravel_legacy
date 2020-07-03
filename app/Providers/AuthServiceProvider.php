<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use App\Policies\GroupPolicy;
use App\Policies\StudentPolicy;
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
            if ($user->admin()) {
                return true;
            }

            return null;
        });

        Gate::define('create-teacher', function (User $user): bool {
            return $user->methodist();
        });

        Gate::define('update-teacher', function (User $user): bool {
            return $user->methodist();
        });

        Gate::define('delete-teacher', function (User $user): bool {
            return $user->methodist();
        });
    }
}
