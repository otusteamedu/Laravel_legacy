<?php

namespace App\Providers;

use App\Services\GitOperations;
use Illuminate\Support\ServiceProvider;

class GitOperationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GitOperations::class, static function() {

            return new GitOperations(config('git.git_binary'));
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
