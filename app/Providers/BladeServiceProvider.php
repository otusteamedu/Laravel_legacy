<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // custom Blade directives:

        // проверка по URI
        Blade::if('request', function($name){
            return request()->is($name);
        });

        // пользователь авторизован ?
        Blade::if('auth', function(){
            $user = auth()->user();
            return $user!=null;
            // также можно и вот так:
            // return Auth::check();
        });

        // пользователь - админ ?
        Blade::if('admin', function(){
            $result = false;
            $user = auth()->user();
            if($user!=null)
            {
                $user->level === User::LEVEL_ADMIN ? $result=true:$result=false;
            }
            return $result;
        });

    }
}
