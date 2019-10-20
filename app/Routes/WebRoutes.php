<?php

namespace App\Routes;

use SebastiaanLuca\Router\Routers\Router;

class WebRoutes extends Router
{
    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->router->group(['namespace' => 'App\Http\Controllers', 'middleware' => ['web']], function () {
            $this->router->auth();
            $this->router->get('/', 'IndexController@welcome')->name('home');
            $this->router->get('/home', 'HomeController@index');
            $this->router->view('/profile', 'profile')
               ->name('profile')
               ->middleware(['can:profile']);
            $this->router->view('/test', 'layouts.bootstrap');
        });

        $this->router->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers', 'middleware' => ['web', 'auth'], 'as' => 'admin.'], function () {
            $this->router->get('/', 'Admin\DashboardController@index')->name('index');
        });
    }
}
