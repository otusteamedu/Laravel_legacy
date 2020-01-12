<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\ReviewPolicy;
use App\Models\Review;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('edit-review', function ($user, $review) {
//            if($user->hasRole('admin')){
//                return true;
//            } else {
//                return $user->id === $review->user_id;
//            }
//        });
//
//        Gate::define('delete-review', function ($user, $review) {
//            if($user->hasRole('admin')){
//                return true;
//            } else {
//                return $user->id === $review->user_id;
//            }
//        });

    }
}
