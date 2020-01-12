<?php

namespace App\Providers;

use App\Services\Products\Repositories\EloquentProductsRepository;
use App\Services\Wishlists\Repositories\EloquentWishlistsRepository;
use App\Services\Products\Repositories\ProductsRepositoryInterface;
use App\Services\Wishlists\Repositories\WishlistsRepositoryInterface;
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
        //
    }

    private function registerBindings()
    {
        $this->app->bind(WishlistsRepositoryInterface::class, EloquentWishlistsRepository::class);
        $this->app->bind(ProductsRepositoryInterface::class, EloquentProductsRepository::class);
    }
}
