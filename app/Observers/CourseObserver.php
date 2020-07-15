<?php

namespace App\Observers;

use App\Models\Course;
use App\Services\Courses\CourseService;

/**
 * Class CourseObserver
 * @package App\Observers
 */
class CourseObserver
{
    /**
     * @var CourseService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param CourseService $service
     */
    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the course "created" event.
     *
     * @param Course $course
     * @return void
     */
    public function created(Course $course)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the course "updated" event.
     *
     * @param Course $course
     * @return void
     */
    public function updated(Course $course)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the course "deleted" event.
     *
     * @param Course $course
     * @return void
     */
    public function deleted(Course $course)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the course "restored" event.
     *
     * @param Course $course
     * @return void
     */
    public function restored(Course $course)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the course "force deleted" event.
     *
     * @param Course $course
     * @return void
     */
    public function forceDeleted(Course $course)
    {
        $this->service->clearCache();
    }
}
