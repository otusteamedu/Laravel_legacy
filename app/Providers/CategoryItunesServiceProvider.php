<?php

namespace App\Providers;

use App\Services\CategoryItunes\Repositories\CategoryItunesRepositoryInterface;
use App\Services\CategoryItunes\Repositories\DbCategoryItunesRepository;
use Illuminate\Support\ServiceProvider;

class CategoryItunesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryItunesRepositoryInterface::class, DbCategoryItunesRepository::class);
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
