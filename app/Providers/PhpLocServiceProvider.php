<?php

namespace App\Providers;

use App\Services\Analyzers\PhpLoc;
use Illuminate\Support\ServiceProvider;

class PhpLocServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PhpLoc::class, static function($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */
            return new PhpLoc($app->basePath() . '/vendor/bin/phploc');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
