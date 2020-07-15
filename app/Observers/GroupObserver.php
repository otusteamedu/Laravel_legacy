<?php

namespace App\Observers;

use App\Models\Group;
use App\Services\Groups\GroupService;

/**
 * Class GroupObserver
 * @package App\Observers
 */
class GroupObserver
{
    /**
     * @var GroupService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param GroupService $service
     */
    public function __construct(GroupService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the group "created" event.
     *
     * @param Group $group
     * @return void
     */
    public function created(Group $group)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the group "updated" event.
     *
     * @param Group $group
     * @return void
     */
    public function updated(Group $group)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the group "deleted" event.
     *
     * @param Group $group
     * @return void
     */
    public function deleted(Group $group)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the group "restored" event.
     *
     * @param Group $group
     * @return void
     */
    public function restored(Group $group)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the group "force deleted" event.
     *
     * @param Group $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        $this->service->clearCache();
    }
}
