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
        $attibutes = [
            'prefix' => '/api',
            'middleware' => ['api'],
            'as' => 'api.',
            'namespace' => 'App\Http\Controllers\Api'
        ];

        $this->router->group($attibutes, function () {
            $this->router->resource('counterparties', 'Counterparty')->except('create', 'edit');
        });
    }
}
