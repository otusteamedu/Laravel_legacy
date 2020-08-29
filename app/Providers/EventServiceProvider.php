<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\EducationPlan;
use App\Models\EducationYear;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Observers\CourseObserver;
use App\Observers\EducationPlanObserver;
use App\Observers\EducationYearObserver;
use App\Observers\GroupObserver;
use App\Observers\LessonObserver;
use App\Observers\SettingObserver;
use App\Observers\StudentObserver;
use App\Observers\SubjectObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Course::observe(CourseObserver::class);
        EducationPlan::observe(EducationPlanObserver::class);
        EducationYear::observe(EducationYearObserver::class);
        Group::observe(GroupObserver::class);
        Student::observe(StudentObserver::class);
        Subject::observe(SubjectObserver::class);
        User::observe(UserObserver::class);
        Setting::observe(SettingObserver::class);
        Lesson::observe(LessonObserver::class);
    }
}
