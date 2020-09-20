<?php

namespace App\Providers;

use App\Services\Repositories\RepositoryInterface;

use App\Services\Adverts\Repositories\AdvertRepositoryInterface;
use App\Services\Adverts\Repositories\EloquentRepository;

use App\Services\Divisions\Repositories\DivisionRepositoryInterface;
use App\Services\Divisions\Repositories\EloquentDivisionRepository;

use App\Services\Towns\Repositories\TownRepositoryInterface;
use App\Services\Towns\Repositories\EloquentTownRepository;

use App\Services\Messages\Repositories\MessageRepositoryInterface;
use App\Services\Messages\Repositories\EloquentMessageRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RepositoryInterface::class,
            \App\Services\Repositories\EloquentRepository::class
        );
        $this->app->bind(
            DivisionRepositoryInterface::class,
            EloquentDivisionRepository::class
        );
        $this->app->bind(
            TownRepositoryInterface::class,
            EloquentTownRepository::class
        );
        $this->app->bind(
            AdvertRepositoryInterface::class,
            EloquentRepository::class
        );
        $this->app->bind(
            MessageRepositoryInterface::class,
            EloquentMessageRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
