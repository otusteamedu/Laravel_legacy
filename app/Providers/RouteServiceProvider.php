<?php

namespace App\Providers;

use App\Routes\ApiRoutes;
use App\Routes\WebRoutes;
use App\Services\Counterparty\Repositories\CounterpartyRepositoryInterface;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use SebastiaanLuca\Router\Routers\Router;

class RouteServiceProvider extends ServiceProvider
{
    /** @var Router[] */
    protected $routes = [
        WebRoutes::class,
        ApiRoutes::class,
    ];

    protected $patterns = [
        'id' => '\d+',
        'hash' => '[a-z0-9]+',
        'uuid' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}',
        'slug' => '[a-z0-9-]+',
        'token' => '[a-zA-Z0-9]{64}',
    ];

    protected $bindingsFromRepository = [
        'counterparty' => CounterpartyRepositoryInterface::class,
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        /** @var \Illuminate\Contracts\Routing\Registrar|\Illuminate\Routing\Router $router */
        $router = $this->app->make(\Illuminate\Contracts\Routing\Registrar::class);
        $router->patterns($this->patterns);
        foreach ($this->bindingsFromRepository as $name => $binder) {
            $router->bind($name, $binder);
        }

        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        foreach ($this->routes as $route) {
            $this->app->make($route);
        }
    }
}
