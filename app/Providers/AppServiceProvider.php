<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        // Предотвращение ошибки SQL 1071 Specified key was too long, возникающей при миграции строки с индексом
        Schema::defaultStringLength(191);

        // Подключение хелперов
        require_once(app_path() . '/Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->app->bind(
//            'App\Listeners\Cache\Category\CategoryClearByTag',
//            'App\Services\Base\Category\CmsBaseCategoryService'
//        );
    }
}
