<?php

namespace App\Observers;

use App\Models\Subject;
use App\Services\Subjects\SubjectService;

/**
 * Class SubjectObserver
 * @package App\Observers
 */
class SubjectObserver
{
    /**
     * @var SubjectService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param SubjectService $service
     */
    public function __construct(SubjectService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the subject "created" event.
     *
     * @param Subject $subject
     * @return void
     */
    public function created(Subject $subject)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the subject "updated" event.
     *
     * @param Subject $subject
     * @return void
     */
    public function updated(Subject $subject)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the subject "deleted" event.
     *
     * @param Subject $subject
     * @return void
     */
    public function deleted(Subject $subject)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the subject "restored" event.
     *
     * @param Subject $subject
     * @return void
     */
    public function restored(Subject $subject)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the subject "force deleted" event.
     *
     * @param Subject $subject
     * @return void
     */
    public function forceDeleted(Subject $subject)
    {
        $this->service->clearCache();
    }
}
