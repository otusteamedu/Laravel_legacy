<?php

namespace App\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @param FormBuilder $formBuilder
     * @return void
     */
    public function boot(FormBuilder $formBuilder)
    {
        // https://laravelcollective.com/docs/6.0/html#custom-components
        $formBuilder::component('bulmaText', 'components.form.text', ['name', 'transKey', 'attributes' => []]);
        $formBuilder::component('bulmaTextarea', 'components.form.textarea', ['name', 'transKey', 'attributes' => []]);
        $formBuilder::component('bulmaNumber', 'components.form.number', ['name', 'transKey', 'attributes' => []]);
        $formBuilder::component('bulmaSelect', 'components.form.select', ['name', 'transKey', 'list' => []]);
        $formBuilder::component('bulmaFile', 'components.form.file', ['name', 'transKey']);
    }
}
