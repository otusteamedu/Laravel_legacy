<?php

namespace App\Observers;

use App\Models\User;
use App\Services\Users\UserService;

/**
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * CourseObserver constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the user "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the user "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->service->clearCache();
    }
}
