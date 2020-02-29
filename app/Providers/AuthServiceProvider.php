<?php

namespace App\Providers;

use App\Models\Page\Page;
use App\Models\Post\Comment;
use App\Models\Post\Post;
use App\Models\Post\Rubric;
use App\Models\Setting\Setting;
use App\Models\User\Group;
use App\Models\User\Right;
use App\Models\User\User;
use App\Policies\Abilities;
use App\Policies\Post\CommentPolicy;
use App\Policies\Page\PagePolicy;
use App\Policies\Post\PostPolicy;
use App\Policies\Post\RubricPolicy;
use App\Policies\Setting\SettingPolicy;
use App\Policies\User\RightPolicy;
use App\Policies\User\GroupPolicy;
use App\Policies\User\UserPolicy;
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
        Page::class => PagePolicy::class,
        Comment::class => CommentPolicy::class,
        Post::class => PostPolicy::class,
        Rubric::class => RubricPolicy::class,
        Group::class => GroupPolicy::class,
        User::class => UserPolicy::class,
        Right::class => RightPolicy::class,
        Setting::class => SettingPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define(Abilities::CMS, function (User $user) {
            return $user->isAdmin();
        });
    }
}
