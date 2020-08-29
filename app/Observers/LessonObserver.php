<?php

namespace App\Observers;

use App\Models\Lesson;
use App\Services\Lessons\LessonService;

/**
 * Class LessonObserver
 * @package App\Observers
 */
class LessonObserver
{
    /**
     * @var LessonService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param LessonService $service
     */
    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the lesson "created" event.
     *
     * @param Lesson $lesson
     * @return void
     */
    public function created(Lesson $lesson)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the lesson "updated" event.
     *
     * @param Lesson $lesson
     * @return void
     */
    public function updated(Lesson $lesson)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the lesson "deleted" event.
     *
     * @param Lesson $lesson
     * @return void
     */
    public function deleted(Lesson $lesson)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the lesson "restored" event.
     *
     * @param Lesson $lesson
     * @return void
     */
    public function restored(Lesson $lesson)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the lesson "force deleted" event.
     *
     * @param Lesson $lesson
     * @return void
     */
    public function forceDeleted(Lesson $lesson)
    {
        $this->service->clearCache();
    }
}
