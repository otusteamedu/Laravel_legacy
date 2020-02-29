<?php

namespace App\Policies\User;

use App\Models\User\Group;
use App\Models\User\User;
use App\Policies\AuthorizationChecker;
use App\Repositories\User\Right\RightRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Настройка прав для модуля группы
 * Class GroupPolicy
 * @package App\Policies\User
 */
class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any groups.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::USERS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::GROUP_LIST);
    }

    /**
     * Determine whether the user can view the group.
     *
     * @param User $user
     * @param  Group  $group
     * @return mixed
     */
    public function view(User $user, Group $group)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::USERS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::GROUP_LIST);
    }

    /**
     * Determine whether the user can create groups.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::USERS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::GROUP_CREATE);
    }

    /**
     * Determine whether the user can update the group.
     *
     * @param User $user
     * @param  Group  $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::USERS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::GROUP_CREATE);
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @param User $user
     * @param  Group  $group
     * @return mixed
     */
    public function delete(User $user, Group $group)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::USERS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::GROUP_CREATE);
    }

    /**
     * Determine whether the user can restore the group.
     *
     * @param User $user
     * @param  Group  $group
     * @return mixed
     */
    public function restore(User $user, Group $group)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::USERS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::GROUP_CREATE);
    }

    /**
     * Determine whether the user can permanently delete the group.
     *
     * @param User $user
     * @param  Group  $group
     * @return mixed
     */
    public function forceDelete(User $user, Group $group)
    {
        return false;
    }
}
