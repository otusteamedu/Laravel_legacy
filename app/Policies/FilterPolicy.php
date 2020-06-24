<?php

namespace App\Policies;

use App\Models\Filter;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FilterPolicy extends BasePolicy
{

    public function before(User $user)
    {
        // Not allowed to use Filter with level lower Admin
        /*parent::before($user);*/
        return $user->isAdmin() ?: null ;
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
//        ddd(isset($user->level));
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
    public function update(User $user, Filter $filter)
    {
//        return $user->isModerator();
        if ($user->isAdmin()) return true;
        return $user->id === $filter->created_user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the filter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function delete(User $user, Filter $filter)
    {
        if ($user->isAdmin()) return true;
        return $user->id === $filter->created_user_id
            ? Response::allow()
            : Response::deny('You do not own this post.')
            ;
    }

    /**
     * Determine whether the user can restore the filter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function restore(User $user, Filter $filter)
    {
        return $user->isAdmin()? Response::allow()
            : Response::deny('You are not Admin.');
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
