<?php

namespace App\Providers;

use App\Repositories\Page\PageRepository;
use App\Repositories\Page\PageRepositoryInterface;
use App\Repositories\Post\Comment\CommentRepository;
use App\Repositories\Post\Comment\CommentRepositoryInterface;
use App\Repositories\Post\Post\PostRepository;
use App\Repositories\Post\Post\PostRepositoryInterface;
use App\Repositories\Post\Rubric\RubricRepository;
use App\Repositories\Post\Rubric\RubricRepositoryInterface;
use App\Repositories\User\Group\GroupRepository;
use App\Repositories\User\Group\GroupRepositoryInterface;
use App\Repositories\User\Right\RightRepository;
use App\Repositories\User\Right\RightRepositoryInterface;
use App\Repositories\User\User\UserRepository;
use App\Repositories\User\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            PageRepositoryInterface::class,
            PageRepository::class
        );

        $this->app->bind(
            RubricRepositoryInterface::class,
            RubricRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->bind(
            RightRepositoryInterface::class,
            RightRepository::class
        );

        $this->app->bind(
            GroupRepositoryInterface::class,
            GroupRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
