<?php

namespace App\Providers;

use App\Providers\Views\BladeStatements;
use App\Services\Filters\Repositories\EloquentFilterRepository;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use App\Services\FilterTypes\Repositories\EloquentFilterTypeRepository;
use App\Services\FilterTypes\Repositories\FilterTypeRepositoryInterface;
use App\Services\Mpolls\Repositories\EloquentMpollRepository;
use App\Services\Mpolls\Repositories\MpollRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

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

        if($this->app->environment('local', 'testing')){
            $this->app->register(DuskServiceProvider::class);
        }
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
        $this->app->bind(FilterTypeRepositoryInterface::class, EloquentFilterTypeRepository::class);
        $this->app->bind(MpollRepositoryInterface::class, EloquentMpollRepository::class);
    }
}
