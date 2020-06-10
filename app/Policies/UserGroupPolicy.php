<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserGroupPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->group->name == UserGroup::ADMIN_GROUP) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return mixed
     */
    public function view(User $user, UserGroup $userGroup)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return mixed
     */
    public function update(User $user, UserGroup $userGroup)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return mixed
     */
    public function delete(User $user, UserGroup $userGroup)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return mixed
     */
    public function restore(User $user, UserGroup $userGroup)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return mixed
     */
    public function forceDelete(User $user, UserGroup $userGroup)
    {
        return false;
    }
}
