<?php

namespace App\Providers;

use App\Services\MacroService;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();
        
        $this->app->singleton('form', function ($app) {
            $form = new MacroService($app['html'], $app['url'], $app['view'], $app['session.store']->token());
            
            return $form->setSessionStore($app['session.store']);
        });
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
