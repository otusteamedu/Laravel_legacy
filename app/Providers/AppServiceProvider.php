<?php

namespace App\Providers;

use App\Services\Articles\Repositories\EloquentArticleRepository;
use App\Services\Articles\Repositories\ArticleRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
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
        $this->registerBindings();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    private function registerBindings()
    {
        $this->app->bind(
            ArticleRepositoryInterface::class,
            EloquentArticleRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        /*
         * @ToDo: удалить код перед вливанием в мастер. Следует запомнить,
         * что можно делать и так. Удобно, если в разных местах интерфейс нужно
         * подменять на разные конкретные классы
         *
         * $this->app->when(UsersService::class)
            ->needs( UserRepositoryInterface::class)
            ->give(function () {
                return new EloquentUserRepository();
            });*/
    }
}
