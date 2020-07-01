<?php

namespace App\Observers;

use App\Models\Project;
use App\Services\Projects\ProjectsCacheService;

class ProjectObserver
{
    /**
     * @var ProjectsCacheService
     */
    private $projectsCacheService;

    public function __construct(ProjectsCacheService $projectsCacheService)
    {
        $this->projectsCacheService = $projectsCacheService;
    }

    /**
     * Handle the project "created" event.
     *
     * @param Project $project
     *
     * @return void
     */
    public function created(Project $project)
    {
        $this->projectsCacheService->clear();
    }

    /**
     * Handle the project "updated" event.
     *
     * @param Project $project
     *
     * @return void
     */
    public function updated(Project $project)
    {
        $this->projectsCacheService->clear();
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param Project $project
     *
     * @return void
     */
    public function deleted(Project $project)
    {
        $this->projectsCacheService->clear();
    }

    /**
     * Handle the project "restored" event.
     *
     * @param Project $project
     *
     * @return void
     */
    public function restored(Project $project)
    {
        $this->projectsCacheService->clear();
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param Project $project
     *
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        $this->projectsCacheService->clear();
    }
}
