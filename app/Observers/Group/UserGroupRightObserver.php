<?php

namespace App\Observers\Group;

use App\Models\UserGroupRight;

class UserGroupRightObserver
{
    /**
     * Handle the user group right "created" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function created(UserGroupRight $userGroupRight): void
    {
        \Cache::delete('user.group.right.list');
    }

    /**
     * Handle the user group right "updated" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function updated(UserGroupRight $userGroupRight)
    {
        \Cache::delete('user.group.right.list');
    }

    /**
     * Handle the user group right "deleted" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function deleted(UserGroupRight $userGroupRight)
    {
        \Cache::delete('user.group.right.list');
    }

    /**
     * Handle the user group right "restored" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function restored(UserGroupRight $userGroupRight)
    {
        \Cache::delete('user.group.right.list');
    }

    /**
     * Handle the user group right "force deleted" event.
     *
     * @param \App\Models\UserGroupRight $userGroupRight
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function forceDeleted(UserGroupRight $userGroupRight)
    {
        \Cache::delete('user.group.right.list');
    }
}
