<?php

namespace App\Providers;

use App\Services\Podcast\Repositories\EloquentPodcastRepository;
use App\Services\Podcast\Repositories\PodcastRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PodcastServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PodcastRepositoryInterface::class, EloquentPodcastRepository::class);
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
