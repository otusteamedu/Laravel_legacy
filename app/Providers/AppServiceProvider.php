<?php

namespace App\Providers;

use App\Http\Controllers\Cms\Cities\CitiesController;
use App\Http\Controllers\Cms\Countries\CountriesController;
use App\Providers\Views\BladeStatements;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Repositories\EloquentCountryRepository;
use App\Services\Countries\Repositories\NativeCountryRepository;
use App\Services\Foo\Bar;
use App\Services\Foo\Foo;
use App\Services\Foo\FooInterface;
use App\Services\SimpleBar;
use App\Services\SimpleFoo;
use App\Services\SMS\Providers\AeroSMSProvider;
use App\Services\SMS\Providers\InfobipProvider;
use App\Services\SMS\Providers\SMSProviderInterface;
use App\Services\SMS\Providers\TurboSMSProvider;
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
        $this->app->bind(
            CountryRepositoryInterface::class,
            EloquentCountryRepository::class
        );

        $this->registerSMSBindings();

        $this->app->when(CountriesController::class)
            ->needs(SimpleFoo::class)
            ->give(function() {
                return new SimpleFoo(
                    new Foo()
                );
            });

        $this->app->when(CitiesController::class)
            ->needs(SimpleFoo::class)
            ->give(function() {
                return new SimpleFoo(
                    new Bar()
                );
            });
//
        $simpleBar = new SimpleBar('Hello');
        $this->app->instance(SimpleBar::class, $simpleBar);

    }

    private function bootBindingsEvents()
    {
        $this->app->resolving(SimpleFoo::class, function (SimpleFoo $simpleFoo, $app) {
            \Log::info('Hey me was created');
            $simpleFoo->saveFoo();
        });
    }

    private function registerSMSBindings()
    {
        $aeroSMSProvider = new AeroSMSProvider(
            config('sms.aero.host'),
            config('sms.aero.api_token')
        );

        $this->app->instance(AeroSMSProvider::class, $aeroSMSProvider);

        $this->app->bind(
            SMSProviderInterface::class,
            AeroSMSProvider::class
        );
    }
}
