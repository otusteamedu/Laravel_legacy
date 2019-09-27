<?php

namespace App\Providers;

use App\Services\Episode\Repositories\EloquentEpisodeRepository;
use App\Services\Episode\Repositories\EpisodeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class EpisodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EpisodeRepositoryInterface::class, EloquentEpisodeRepository::class);
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
