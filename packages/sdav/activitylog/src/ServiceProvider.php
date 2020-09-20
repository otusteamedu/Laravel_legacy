<?php

namespace Sdav\ActivityLog;
use Illuminate\Routing\Router;
use Sdav\ActivityLog\Http\Middleware;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {

    }

    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $router = $this->app->make(Router::class);

        $router->pushMiddlewareToGroup('web', Middleware\ActivityLog::class);
    }
}
