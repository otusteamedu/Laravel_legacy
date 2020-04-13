<?php

namespace Lara\Callback;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'callback');
        $this->loadRoutesFrom(__DIR__ . '/../routes/callback.php');
        $this->publishes([__DIR__ . '/../config/callback.php' => config_path('callback.php')]);
        $this->publishes([
            __DIR__ . '/../resources/images' => public_path('images'),
        ], 'images');
        $this->publishes([
            __DIR__ . '/../resources/css' => public_path('css'),
        ], 'css');
        $this->publishes([
            __DIR__ . '/../resources/js' => public_path('js'),
        ], 'js');

    }

    public function register()
    {

    }

}