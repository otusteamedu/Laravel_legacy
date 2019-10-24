<?php

namespace App\Routes;

use SebastiaanLuca\Router\Routers\Router;

class ApiRoutes extends Router
{
    /**
     * Map the routes.
     */
    public function map(): void
    {
        $attributes = [
            'prefix' => '/api',
            'middleware' => ['api'],
            'as' => 'api.',
            'namespace' => 'App\Http\Controllers\Api'
        ];

        $this->router->group($attributes, function () {
            $this->router->resource('counterparties', 'Counterparty')->except('create', 'edit');
        });
    }
}
