<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
use App\Models\UserGroup;
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
        'App\Models\Article' => 'App\Policies\ArticlePolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\UserGroup' => 'App\Policies\UserGroupPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('hasAdminAccess', function (User $user) {
            $allowedUserGroups = [UserGroup::ADMIN_GROUP, UserGroup::EDITOR_GROUP, UserGroup::AUTHOR_GROUP, UserGroup::MODERATOR_GROUP];
            return in_array($user->group->name, $allowedUserGroups);
        });
    }
}
