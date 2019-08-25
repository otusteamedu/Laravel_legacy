<?php

namespace App\Providers;

use App\Providers\Views\BladeStatements;
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
        //
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
}
