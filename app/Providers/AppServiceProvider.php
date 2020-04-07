<?php

namespace App\Providers;

use App\Services\Articles\Repositories\EloquentArticleRepository;
use App\Services\Articles\Repositories\ArticleRepositoryInterface;
use App\Services\Events\Repositories\EloquentEventRepository;
use App\Services\Events\Repositories\EventRepositoryInterface;
use App\Services\News\Repositories\EloquentNewsRepository;
use App\Services\Languages\Repositories\EloquentLanguageRepository;
use App\Services\Languages\Repositories\LanguageRepositoryInterface;
use App\Services\News\Repositories\NewsRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use App\Services\Pictures\Repositories\EloquentPictureRepository;
use App\Services\Pictures\Repositories\PictureRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

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

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
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
            EventRepositoryInterface::class,
            EloquentEventRepository::class
        );

        $this->app->bind(
            NewsRepositoryInterface::class,
            EloquentNewsRepository::class
        );

        $this->app->bind(
            LanguageRepositoryInterface::class,
            EloquentLanguageRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            PictureRepositoryInterface::class,
            EloquentPictureRepository::class
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
