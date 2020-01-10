<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any reviews.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function view(User $user, Review $review)
    {
        //
    }

    /**
     * Determine whether the user can create reviews.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function update(User $user, Review $review)
    {
        if($user->hasRole('admin')){
            return true;
        } else {
            return $user->id === $review->user_id;
        }
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function delete(User $user, Review $review)
    {
        if($user->hasRole('admin')){
                return true;
            } else {
                return $user->id === $review->user_id;
            }
    }

    /**
     * Determine whether the user can restore the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function restore(User $user, Review $review)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function forceDelete(User $user, Review $review)
    {
        //
    }
}
