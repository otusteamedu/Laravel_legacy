<?php

namespace App\Policies;

use App\Models\Filter;
use App\Models\User;

class FilterPolicy extends BasePolicy
{

    public function before(User $user)
    {
        // Not allowed to use Filter with level lower Admin
        /*parent::before($user);*/
        return $user->isAdmin() ;
    }

    /**
     * Determine whether the user can view any filters.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user): bool
    {
//        return $user->isModerator();
//        dd(($user->level));
        return isset($user->level);
    }

    /**
     * Determine whether the user can view the filter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function view(User $user, Filter $filter)
    {
        return $user->isModerator();
//       return $user->id === $filter->created_user_id;
    }

    /**
     * Determine whether the user can create filters.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user) : bool
    {
        return isset($user->level);
    }

    /**
     * Determine whether the user can update the filter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function update(User $user, Filter $filter) :bool
    {
//        return $user->isModerator();
        return $user->isAdmin() or ($user->id === $filter->created_user_id) ;
    }

    /**
     * Determine whether the user can delete the filter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function delete(User $user, Filter $filter) :bool
    {
        return $user->isAdmin() or ($user->id === $filter->created_user_id) ;
    }

    /**
     * Determine whether the user can restore the filter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function restore(User $user, Filter $filter) :bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the filter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function forceDelete(User $user, Filter $filter) :bool
    {
        return $user->isAdmin();
    }
}
