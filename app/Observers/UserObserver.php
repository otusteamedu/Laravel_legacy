<?php

namespace App\Observers;

use App\Services\Users\UsersCacheService;
use App\Models\User;

class UserObserver
{

    /**
     * @var UsersCacheService
     */
    private $usersCacheService;

    public function __construct(UsersCacheService $usersCacheService)
    {
        $this->usersCacheService = $usersCacheService;
    }

    /**
     * Handle the user "created" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function created(User $user)
    {
        $this->usersCacheService->clear();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function updated(User $user)
    {
        $this->usersCacheService->clear();
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function deleted(User $user)
    {
        $this->usersCacheService->clear();
    }

    /**
     * Handle the user "restored" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function restored(User $user)
    {
        $this->usersCacheService->clear();
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->usersCacheService->clear();
    }
}
