<?php

namespace App\Providers;

use App\Services\Courses\Repositories\CourseRepositoryInterface;
use App\Services\Courses\Repositories\EloquentCourseRepository;
use App\Services\EducationPlans\Repositories\EducationPlanRepositoryInterface;
use App\Services\EducationPlans\Repositories\EloquentEducationPlanRepository;
use App\Services\Lessons\Repositories\EloquentLessonRepository;
use App\Services\Lessons\Repositories\LessonRepositoryInterface;
use App\Services\Posts\Repositories\EloquentPostRepository;
use App\Services\Posts\Repositories\PostRepositoryInterface;
use App\Services\Settings\Repositories\EloquentSettingRepository;
use App\Services\Settings\Repositories\SettingRepositoryInterface;
use App\Services\Students\Repositories\EloquentStudentRepository;
use App\Services\Students\Repositories\StudentRepositoryInterface;
use App\Services\Subjects\Repositories\EloquentSubjectRepository;
use App\Services\Subjects\Repositories\SubjectRepositoryInterface;
use App\Services\Teachers\Repositories\EloquentTeacherRepository;
use App\Services\Teachers\Repositories\TeacherRepositoryInterface;
use App\Services\Telegram\Repositories\EloquentTelegramRepository;
use App\Services\Telegram\Repositories\TelegramRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use App\Services\Years\Repositories\EloquentYearRepository;
use App\Services\Years\Repositories\YearRepositoryInterface;
use App\Services\Groups\Repositories\EloquentGroupRepository;
use App\Services\Groups\Repositories\GroupRepositoryInterface;
use Illuminate\Http\Request;
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
        SettingRepositoryInterface::class => EloquentSettingRepository::class,
        PostRepositoryInterface::class => EloquentPostRepository::class,
        TelegramRepositoryInterface::class => EloquentTelegramRepository::class,
        LessonRepositoryInterface::class => EloquentLessonRepository::class,
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
    public function boot(Request $request)
    {
        if (env('USE_NGROK_LOCAL', false)) {
            if ($request->server->has('HTTP_X_ORIGINAL_HOST')) {
                $this->app['url']->forceRootUrl('https://' . $request->server->get('HTTP_X_ORIGINAL_HOST'));
            }
        }
    }
}
