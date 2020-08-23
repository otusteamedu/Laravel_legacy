<?php

namespace App\Observers;

use App\Models\User;
use App\Services\UsersService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{
    /**
     * @var UsersService
     */
    private $userService;

    /**
     * UserObserver constructor.
     * @param UsersService $userService
     */
    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the article "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        $this->userService->clearCache();
    }

    /**
     * Handle the article "updated" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->userService->clearCache();
    }

    /**
     * Handle the article "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->userService->clearCache();
    }

    /**
     * Handle the article "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->userService->clearCache();
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->userService->clearCache();
    }
}
