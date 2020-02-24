<?php

namespace App\Policies\User;

use App\Models\User\User;
use App\Repositories\User\Right\RightRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Настройка прав для модуля Пользователи
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::USERS) !== false
            && $userRights->search(RightRepository::USER_LIST) !== false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  User $baseUser
     * @return mixed
     */
    public function view(User $user, User $baseUser)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && (
                ($user->id === $baseUser->id)
                || ($userRights->search(RightRepository::USERS) !== false
                    && $userRights->search(RightRepository::USER_LIST) !== false)
            );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::USERS) !== false
            && $userRights->search(RightRepository::USER_CREATE) !== false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  User $baseUser
     * @return mixed
     */
    public function update(User $user, User $baseUser)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && (
                ($user->id === $baseUser->id)
                || ($userRights->search(RightRepository::USERS) !== false
                    && $userRights->search(RightRepository::USER_CREATE) !== false)
            );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  User $baseUser
     * @return mixed
     */
    public function delete(User $user, User $baseUser)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $user->id !== $baseUser->id
            && $userRights->search(RightRepository::USERS) !== false
            && $userRights->search(RightRepository::USER_CREATE) !== false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param User $baseUser
     * @return mixed
     */
    public function restore(User $user, User $baseUser)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $user->id !== $baseUser->id
            && $userRights->search(RightRepository::USERS) !== false
            && $userRights->search(RightRepository::USER_CREATE) !== false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $baseUser
     * @return mixed
     */
    public function forceDelete(User $user, User $baseUser)
    {
        return false;
    }
}
