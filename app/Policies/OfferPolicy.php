<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    protected $entity = 'offer';

    /**
     * Determine whether the user can view any offers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return mixed
     */
    public function view(User $user, Offer $offer)
    {
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));    }

    /**
     * Determine whether the user can create offers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));    }

    /**
     * Determine whether the user can update the offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return mixed
     */
    public function update(User $user, Offer $offer)
    {
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));
    }

    /**
     * Determine whether the user can delete the offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return mixed
     */
    public function delete(User $user, Offer $offer)
    {
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));
    }

    /**
     * Determine whether the user can restore the offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return mixed
     */
    public function restore(User $user, Offer $offer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return mixed
     */
    public function forceDelete(User $user, Offer $offer)
    {
        //
    }
}
