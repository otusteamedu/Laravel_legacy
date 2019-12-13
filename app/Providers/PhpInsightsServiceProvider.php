<?php

namespace App\Providers;

use App\Services\Analyzers\PhpInsights;
use Illuminate\Support\ServiceProvider;

class PhpInsightsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PhpInsights::class, static function($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */
            return new PhpInsights($app->basePath() . '/vendor/bin/phpinsights');
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
