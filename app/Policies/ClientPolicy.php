<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return in_array($user->group_id, [Group::STAFF_ADMIN, Group::STAFF_MANAGER]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $modelsUser
     * @return mixed
     */
    public function view(User $user, User $modelsUser)
    {
        return in_array($user->group_id, [Group::STAFF_ADMIN, Group::STAFF_MANAGER])
            || $user->id === $modelsUser->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->group_id, [Group::STAFF_ADMIN, Group::STAFF_MANAGER]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $modelsUser
     * @return mixed
     */
    public function update(User $user, User $modelsUser)
    {
        return in_array($user->group_id, [Group::STAFF_ADMIN, Group::STAFF_MANAGER]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $modelsUser
     * @return mixed
     */
    public function delete(User $user, User $modelsUser)
    {
        return in_array($user->group_id, [Group::STAFF_ADMIN]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $modelsUser
     * @return mixed
     */
    public function restore(User $user, User $modelsUser)
    {
        return in_array($user->group_id, [Group::STAFF_ADMIN, Group::STAFF_MANAGER]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $modelsUser
     * @return mixed
     */
    public function forceDelete(User $user, User $modelsUser)
    {
        return in_array($user->group_id, [Group::STAFF_ADMIN]);
    }
}
