<?php

namespace App\Providers;

use App\Models\Products;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\WishlistProduct;
use App\Policies\ProductsPolicy;
use App\Policies\UserPolicy;
use App\Policies\WishlistPolicy;
use App\Policies\WishlistProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Wishlist::class => WishlistPolicy::class,
        WishlistProduct::class => WishlistProductPolicy::class,
        Products::class => ProductsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
