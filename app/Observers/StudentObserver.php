<?php

namespace App\Observers;

use App\Models\Student;
use App\Services\Students\StudentService;

/**
 * Class StudentObserver
 * @package App\Observers
 */
class StudentObserver
{
    /**
     * @var StudentService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param StudentService $service
     */
    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the student "created" event.
     *
     * @param Student $student
     * @return void
     */
    public function created(Student $student)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the student "updated" event.
     *
     * @param Student $student
     * @return void
     */
    public function updated(Student $student)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the student "deleted" event.
     *
     * @param Student $student
     * @return void
     */
    public function deleted(Student $student)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the student "restored" event.
     *
     * @param Student $student
     * @return void
     */
    public function restored(Student $student)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the student "force deleted" event.
     *
     * @param Student $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        $this->service->clearCache();
    }
}
