<?php

namespace App\Observers\Group;

use App\Models\UserGroupRight;
use App\Services\UserGroup\UserGroupRightService;

class UserGroupRightObserver
{
    protected UserGroupRightService $userGroupRightService;

    public function __construct(UserGroupRightService $userGroupRightService)
    {
        $this->userGroupRightService = $userGroupRightService;
    }

    /**
     * Handle the user group right "created" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function created(UserGroupRight $userGroupRight): void
    {
        $this->userGroupRightService->clearCache();
    }

    /**
     * Handle the user group right "updated" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function updated(UserGroupRight $userGroupRight): void
    {
        $this->userGroupRightService->clearCache();
    }

    /**
     * Handle the user group right "deleted" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function deleted(UserGroupRight $userGroupRight): void
    {
        $this->userGroupRightService->clearCache();
    }

    /**
     * Handle the user group right "restored" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function restored(UserGroupRight $userGroupRight): void
    {
        $this->userGroupRightService->clearCache();
    }

    /**
     * Handle the user group right "force deleted" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function forceDeleted(UserGroupRight $userGroupRight): void
    {
        $this->userGroupRightService->clearCache();
    }
}
