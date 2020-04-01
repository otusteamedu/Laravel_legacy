<?php

namespace App\Providers;

use App\Providers\Views\BladeStatements;
use App\Services\Filters\Repositories\EloquentFilterRepository;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use BladeStatements;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeStatements();
    }


    private function registerBindings()
    {
        $this->app->bind(FilterRepositoryInterface::class, EloquentFilterRepository::class);
    }
}
