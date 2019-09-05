<?php


namespace App\Routes;


use SebastiaanLuca\Router\Routers\Router;

class WebRoutes extends Router
{

    /**
     * Map the routes.
     *
     * @return void
     */
    public function map(): void
    {
        $this->router->group(['namespace' => 'App\Http\Controllers', 'middleware' => ['web']], function () {
           $this->router->auth();
           $this->router->get('/', 'IndexController@welcome');
           $this->router->get('/home', 'HomeController@index');
           $this->router->view('/profile', 'profile')->name('profile');
        });
    }
}
