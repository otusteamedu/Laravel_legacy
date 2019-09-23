<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        Paginator::defaultView('components.pagination.default');

        \Form::component('bulmaText', 'components.form.text', ['name', 'transKey', 'attributes' => []]);
        \Form::component('bulmaTextarea', 'components.form.textarea', ['name', 'transKey', 'attributes' => []]);
        \Form::component('bulmaSelect', 'components.form.select', ['name', 'transKey', 'list' => []]);
        \Form::component('bulmaFile', 'components.form.file', ['name', 'transKey']);
    }
}
