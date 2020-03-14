<?php
/**
 * Регистрация в сервис-контейнере Laravel.
 */

namespace App\Services\Cache;

use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Services\Cache\Repositories\CacheRepositoryInterface',
            'App\Services\Cache\Repositories\CacheRepository'
        );
    }
}
