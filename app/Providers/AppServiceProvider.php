<?php

namespace App\Providers;

use App\Services\Courses\Repositories\CourseRepositoryInterface;
use App\Services\Courses\Repositories\EloquentCourseRepository;
use App\Services\EducationPlans\Repositories\EducationPlanRepositoryInterface;
use App\Services\EducationPlans\Repositories\EloquentEducationPlanRepository;
use App\Services\Students\Repositories\EloquentStudentRepository;
use App\Services\Students\Repositories\StudentRepositoryInterface;
use App\Services\Subjects\Repositories\EloquentSubjectRepository;
use App\Services\Subjects\Repositories\SubjectRepositoryInterface;
use App\Services\Teachers\Repositories\EloquentTeacherRepository;
use App\Services\Teachers\Repositories\TeacherRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
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
        StudentRepositoryInterface::class => EloquentStudentRepository::class,
        UserRepositoryInterface::class => EloquentUserRepository::class,
        TeacherRepositoryInterface::class => EloquentTeacherRepository::class,
        SubjectRepositoryInterface::class => EloquentSubjectRepository::class,
        EducationPlanRepositoryInterface::class => EloquentEducationPlanRepository::class,
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
