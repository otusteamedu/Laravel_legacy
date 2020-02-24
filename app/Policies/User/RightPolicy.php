<?php

namespace App\Policies\User;

use App\Models\User\User;
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
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::USERS) !== false
            && $userRights->search(RightRepository::RIGHT_LIST) !== false;
    }
}
