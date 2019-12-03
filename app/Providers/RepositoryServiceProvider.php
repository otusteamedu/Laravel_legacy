<?php

namespace AElsukov\Providers;

use AElsukov\Repository\Element\ElementRepository;
use AElsukov\Repository\Element\ElementRepositoryInterface;
use AElsukov\Repository\Section\SectionRepository;
use AElsukov\Repository\Section\SectionRepositoryInterface;
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
            SectionRepositoryInterface::class,
            SectionRepository::class
        );

        $this->app->bind(
            ElementRepositoryInterface::class,
            ElementRepository::class
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
