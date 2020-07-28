<?php

namespace App\Providers;

use App\Services\Films\Repositories\FilmRepositoryInterface;
use App\Services\Films\Repositories\EloquentFilmRepository;

use App\Services\Pages\Repositories\PageRepositoryInterface;
use App\Services\Pages\Repositories\EloquentPageRepository;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

use App\Helpers\RouteBuilder;

class AppServiceProvider extends ServiceProvider
{
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
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(['header' => 'main_navigation', 'can'=>'main_navigation']);
            $event->menu->add(
                [
                'text' => "pages",
                'url' => RouteBuilder::localeRoute('cms.pages.index'),
                'can'=>'pages'
            ]
            );
            $event->menu->add(
                [
                'text' => "films",
                'url' => RouteBuilder::localeRoute('cms.films.index'),
                'can'=>'films'
            ]
            );
        });
    }

    private function registerBindings()
    {
        // $this->app->bind(FooInterface::class, Foo::class);
        $this->app->bind(FilmRepositoryInterface::class, EloquentFilmRepository::class);
        $this->app->bind(PageRepositoryInterface::class, EloquentPageRepository::class);
    }
}