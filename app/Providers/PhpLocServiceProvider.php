<?php

namespace App\Providers;

use App\Console\PhpLocCommand;
use Illuminate\Support\ServiceProvider;

class PhpLocServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->singleton('command.phploc', function () {
            return new PhpLocCommand();
        });
        $this->commands('command.phploc');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.phploc'];
    }
}
