<?php

namespace App\Providers;

use App\Http\Controllers\Cms\Cities\CitiesController;
use App\Http\Controllers\Cms\Countries\CountriesController;
use App\Providers\Views\BladeStatements;
use App\Services\Cities\Repositories\CityRepositoryInterface;
use App\Services\Cities\Repositories\EloquentCityRepository;
use App\Services\Countries\Repositories\CachedCountryRepository;
use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Repositories\EloquentCountryRepository;
use App\Services\Foo\Bar;
use App\Services\Foo\Foo;
use App\Services\Foo\FooInterface;
use App\Services\SimpleBar;
use App\Services\SimpleFoo;
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
        
        $this->bootBindingsEvents();
    }

    private function registerBindings()
    {
        $this->app->bind(FooInterface::class, Foo::class);
        $this->app->bind(CountryRepositoryInterface::class, EloquentCountryRepository::class);
        $this->app->bind(CityRepositoryInterface::class, EloquentCityRepository::class);
        $this->app->bind(CachedCountryRepositoryInterface::class, CachedCountryRepository::class);

        $this->app->when(CountriesController::class)
            ->needs(SimpleFoo::class)
            ->give(function() {
                return new SimpleFoo(
                    new Bar()
                );
            });

        $simpleBar = new SimpleBar(config('app.name'));

        $this->app->instance(SimpleBar::class, $simpleBar);

    }

    private function bootBindingsEvents()
    {
        $this->app->resolving(SimpleFoo::class, function (SimpleFoo $simpleFoo, $app) {
            \Log::info('Hey me was created');
            $simpleFoo->saveFoo([]);
        });
    }
}
