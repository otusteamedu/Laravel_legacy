<?php

namespace App\Providers;

use App\Http\Controllers\Cms\Cities\CitiesController;
use App\Http\Controllers\Cms\Countries\CountriesController;
use App\Providers\Views\BladeStatements;
use App\Services\Countries\Repositories\CachedCountryRepository;
use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Repositories\EloquentCountryRepository;
use App\Services\Foo\Bar;
use App\Services\Foo\Foo;
use App\Services\Foo\FooInterface;
use App\Services\Invoices\Services\InvoicesService;
use App\Services\Invoices\Services\InvoicesServiceInterface;
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
        $this->app->bind(InvoicesServiceInterface::class, InvoicesService::class);

    }

    private function bootBindingsEvents()
    {

    }
}
