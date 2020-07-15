<?php

namespace App\Observers;

use App\Models\EducationPlan;
use App\Services\EducationPlans\EducationPlanService;

/**
 * Class EducationPlanObserver
 * @package App\Observers
 */
class EducationPlanObserver
{
    /**
     * @var EducationPlanService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param EducationPlanService $service
     */
    public function __construct(EducationPlanService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the education plan "created" event.
     *
     * @param EducationPlan $educationPlan
     * @return void
     */
    public function created(EducationPlan $educationPlan)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education plan "updated" event.
     *
     * @param EducationPlan $educationPlan
     * @return void
     */
    public function updated(EducationPlan $educationPlan)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education plan "deleted" event.
     *
     * @param EducationPlan $educationPlan
     * @return void
     */
    public function deleted(EducationPlan $educationPlan)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education plan "restored" event.
     *
     * @param EducationPlan $educationPlan
     * @return void
     */
    public function restored(EducationPlan $educationPlan)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the education plan "force deleted" event.
     *
     * @param EducationPlan $educationPlan
     * @return void
     */
    public function forceDeleted(EducationPlan $educationPlan)
    {
        $this->service->clearCache();
    }
}
