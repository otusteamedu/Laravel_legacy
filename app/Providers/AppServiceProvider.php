<?php

namespace App\Providers;

use App\Services\Category\Repositories\CategoryRepositoryInterface;
use App\Services\Category\Repositories\EloquentCategoryRepository;
use App\Services\Product\Repositories\EloquentProductRepository;
use App\Services\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class  AppServiceProvider extends ServiceProvider
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
        //
    }

    private function registerBindings()
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class
        );
        $this->app->bind(
            ProductRepositoryInterface::class,
            EloquentProductRepository::class
        );
    }
}
