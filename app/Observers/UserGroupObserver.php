<?php

namespace App\Observers;

use App\Models\UserGroup;
use App\Services\UserGroupsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class UserGroupObserver
 * @package App\Observers
 */
class UserGroupObserver
{
    /**
     * @var UserGroupsService
     */
    private $userGroupsService;

    /**
     * UserGroupObserver constructor.
     * @param UserGroupsService $userGroupGroupsService
     */
    public function __construct(UserGroupsService $userGroupGroupsService)
    {
        $this->userGroupsService = $userGroupGroupsService;
    }

    /**
     * Handle the article "created" event.
     *
     * @param UserGroup $userGroup
     * @return void
     */
    public function created(UserGroup $userGroup)
    {
        $this->userGroupsService->clearCache();
    }

    /**
     * Handle the article "updated" event.
     *
     * @param \App\Models\UserGroup $userGroup
     * @return void
     */
    public function updated(UserGroup $userGroup)
    {
        $this->userGroupsService->clearCache();
    }

    /**
     * Handle the article "deleted" event.
     *
     * @param UserGroup $userGroup
     * @return void
     */
    public function deleted(UserGroup $userGroup)
    {
        $this->userGroupsService->clearCache();
    }

    /**
     * Handle the article "restored" event.
     *
     * @param UserGroup $userGroup
     * @return void
     */
    public function restored(UserGroup $userGroup)
    {
        $this->userGroupsService->clearCache();
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param UserGroup $userGroup
     * @return void
     */
    public function forceDeleted(UserGroup $userGroup)
    {
        $this->userGroupsService->clearCache();
    }
}
