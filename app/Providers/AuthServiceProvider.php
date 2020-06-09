<?php

namespace App\Providers;

use App\Models\Advert;
use App\Models\Division;
use App\Models\Message;
use App\Models\User;
use App\Policies\DivisionPolicy;
use App\Policies\HomePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Division::class => DivisionPolicy::class,   //регистрация политики
        Advert::class => HomePolicy::class,
        Message::class => HomePolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::before(function (User $user){
//            return $user->id ==1;
//        });

//        Gate::define('show', function (User $user){
//            return $user->id ==1;
//        });
//
//        Gate::define('update', function (User $user){
//            return $user->id ==1;
//        });

//        Gate::define('advert-update', function ($user, $advert){
//
//            if($user->id ==1){
//                return true;
//            } elseif($user->id == $advert->user_id)  {
//                return true;
//            }
//            return false;
//        });
//
//        Gate::define('message-update', function ($user, $item){
//
//            if($user->id ==1){
//                return true;
//            } elseif($user->id == $item->user_id)  {
//                return true;
//            }
//            return false;
//        });
    }
}
