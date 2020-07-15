<?php

namespace App\Observers;

use App\Models\EducationYear;
use App\Services\Years\YearService;

/**
 * Class EducationYearObserver
 * @package App\Observers
 */
class EducationYearObserver
{
    /**
     * @var YearService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param YearService $service
     */
    public function __construct(YearService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the education year "created" event.
     *
     * @param EducationYear $educationYear
     * @return void
     */
    public function created(EducationYear $educationYear)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education year "updated" event.
     *
     * @param EducationYear $educationYear
     * @return void
     */
    public function updated(EducationYear $educationYear)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education year "deleted" event.
     *
     * @param EducationYear $educationYear
     * @return void
     */
    public function deleted(EducationYear $educationYear)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education year "restored" event.
     *
     * @param EducationYear $educationYear
     * @return void
     */
    public function restored(EducationYear $educationYear)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education year "force deleted" event.
     *
     * @param EducationYear $educationYear
     * @return void
     */
    public function forceDeleted(EducationYear $educationYear)
    {
        $this->service->clearCache();
    }
}
