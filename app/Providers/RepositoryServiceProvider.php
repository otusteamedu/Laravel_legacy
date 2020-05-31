<?php

namespace App\Providers;

use App\Services\Divisions\Repositories\DivisionRepositoryInterface;
use App\Services\Divisions\Repositories\EloquentDivisionRepository;
use App\Services\Towns\Repositories\TownRepositoryInterface;
use App\Services\Towns\Repositories\EloquentTownRepository;

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
            DivisionRepositoryInterface::class,
            EloquentDivisionRepository::class
        );
        $this->app->bind(
            TownRepositoryInterface::class,
            EloquentTownRepository::class
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
