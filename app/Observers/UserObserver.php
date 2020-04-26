<?php

namespace App\Observers;

use App\Http\Services\Users\UsersService;
use App\Models\User;

class UserObserver
{

    protected $usersService;

    public function __construct(
        UsersService $usersService
    ) {
        $this->usersService = $usersService;
    }

    /**
     * Событие после создания записи
     *
     * @param User $users
     * @return void
     */
    public function created(User $users)
    {
        $this->usersService->clearAdminUserCache();
    }

    /**
     * Событие после обновления записи
     *
     * @param User $users
     * @return void
     */
    public function updating(User $users)
    {
        $this->usersService->clearAdminUserCache();
    }

    /**
     * Событие после удаления записи
     *
     * @param User $users
     * @return void
     */
    public function deleted(User $users)
    {
        $this->usersService->clearAdminUserCache();
    }

}
