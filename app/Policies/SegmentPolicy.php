<?php

namespace App\Policies;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SegmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any segments.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can view the segment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Segment $segment
     * @return mixed
     */
    public function view(User $user, Segment $segment)
    {
        return $user->canDo(__FUNCTION__, $segment->entityName);

    }

    /**
     * Determine whether the user can create segments.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user, Segment $segment)
    {
        return $user->canDo(__FUNCTION__, $segment->entityName);

    }

    /**
     * Determine whether the user can update the segment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Segment $segment
     * @return mixed
     */
    public function update(User $user, Segment $segment)
    {
        return $user->canDo(__FUNCTION__, $segment->entityName);

    }

    /**
     * Determine whether the user can delete the segment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Segment $segment
     * @return mixed
     */
    public function delete(User $user, Segment $segment)
    {
        return $user->canDo(__FUNCTION__, $segment->entityName);

    }

    /**
     * Determine whether the user can restore the segment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Segment $segment
     * @return mixed
     */
    public function restore(User $user, Segment $segment)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can permanently delete the segment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Segment $segment
     * @return mixed
     */
    public function forceDelete(User $user, Segment $segment)
    {
        return config('user-actions.default-value-if-null');
    }
}
