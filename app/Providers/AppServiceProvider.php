<?php

namespace App\Providers;

use App\Contract\Repository\Menu\LinkRepositoryInterface;
use App\Contract\Service\Menu\LinkServiceInterface;
use App\Repository\Menu\LinkRepository;
use App\Service\Menu\LinkService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        LinkServiceInterface::class => LinkService::class,
        LinkRepositoryInterface::class => LinkRepository::class,
    ];

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
        //
    }
}
