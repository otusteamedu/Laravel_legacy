<?php

namespace App\Providers;

use App\Providers\Faker\Image;
use Faker\Generator;
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
        // Добавляем свой провадер для генерации рандомных картинок.
        $faker = $this->app->make(Generator::class);
        $faker->addProvider(new Image($faker));
    }
}
