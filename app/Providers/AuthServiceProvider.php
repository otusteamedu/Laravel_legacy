<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Wishlist;
use App\Models\WishlistProduct;
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
