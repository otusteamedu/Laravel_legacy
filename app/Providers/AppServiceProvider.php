<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\UserGroup;
use App\Observers\ArticleObserver;
use App\Observers\CategoryObserver;
use App\Observers\UserGroupObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
        Category::observe(CategoryObserver::class);
        User::observe(UserObserver::class);
        UserGroup::observe(UserGroupObserver::class);
    }
}
