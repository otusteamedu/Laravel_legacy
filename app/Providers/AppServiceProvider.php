<?php

namespace App\Providers;

use App\Models\Page\Page;
use App\Models\Post\Comment;
use App\Models\Post\Post;
use App\Models\Post\Rubric;
use App\Observers\Post\CommentObserver;
use App\Observers\Page\PageObserver;
use App\Observers\Post\PostObserver;
use App\Observers\Post\RubricObserver;
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
        Page::observe(PageObserver::class);
        Rubric::observe(RubricObserver::class);
        Comment::observe(CommentObserver::class);
        Post::observe(PostObserver::class);
    }
}
