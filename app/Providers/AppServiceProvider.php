<?php

namespace App\Providers;

use App\Services\Courses\Repositories\CourseRepositoryInterface;
use App\Services\Courses\Repositories\EloquentCourseRepository;
use App\Services\Years\Repositories\EloquentYearRepository;
use App\Services\Years\Repositories\YearRepositoryInterface;
use App\Services\Groups\Repositories\EloquentGroupRepository;
use App\Services\Groups\Repositories\GroupRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** @var array  */
    public $bindings = [
        GroupRepositoryInterface::class => EloquentGroupRepository::class,
        YearRepositoryInterface::class => EloquentYearRepository::class,
        CourseRepositoryInterface::class => EloquentCourseRepository::class,
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
