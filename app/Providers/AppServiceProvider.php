<?php

namespace App\Providers;

use App\Services\Films\Repositories\FilmRepositoryInterface;
use App\Services\Films\Repositories\EloquentFilmRepository;

use App\Services\Pages\Repositories\PageRepositoryInterface;
use App\Services\Pages\Repositories\EloquentPageRepository;

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
        //$this->bootBladeStatements();
    }

    private function registerBindings()
    {
       // $this->app->bind(FooInterface::class, Foo::class);
        $this->app->bind(FilmRepositoryInterface::class, EloquentFilmRepository::class);
        $this->app->bind(PageRepositoryInterface::class, EloquentPageRepository::class);


    }
}
