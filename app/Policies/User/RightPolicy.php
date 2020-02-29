<?php

namespace App\Policies\User;

use App\Models\User\User;
use App\Policies\AuthorizationChecker;
use App\Repositories\User\Right\RightRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Настройка прав для модуля права
 * Class RightPolicy
 * @package App\Policies
 */
class RightPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any rights.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::USERS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::RIGHT_LIST);
    }
}
