<?php


namespace Lara\Calendar;


use Lara\Calendar\Services\Repositories\CalendarInterface;
use Lara\Calendar\Services\Repositories\CalendarRepository;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->bind(CalendarInterface::class, CalendarRepository::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../views', 'calendar');
    }
}
