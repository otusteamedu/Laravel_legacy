<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Categories\Repositories\CategoryRepositoryInterface;
use App\Services\Categories\Repositories\EloquentCategoryRepository;

use App\Services\Products\Repositories\ProductRepositoryInterface;
use App\Services\Products\Repositories\EloquentProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
