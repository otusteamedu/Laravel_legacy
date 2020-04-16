<?php

namespace App\Policies;

use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any countries.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can view the country.
     *
     * @param User $user
     * @param Country $country
     * @return mixed
     */
    public function view(User $user, Country $country)
    {
        return $user->canDo(__FUNCTION__, $country->entityName);
    }

    /**
     * Determine whether the user can create countries.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user, Country $country)
    {
        return $user->canDo(__FUNCTION__, $country->entityName);
    }

    /**
     * Determine whether the user can update the country.
     *
     * @param User $user
     * @param Country $country
     * @return mixed
     */
    public function update(User $user, Country $country)
    {
        return $user->canDo(__FUNCTION__, $country->entityName);
    }

    /**
     * Determine whether the user can delete the country.
     *
     * @param User $user
     * @param Country $country
     * @return mixed
     */
    public function delete(User $user, Country $country)
    {
        return $user->canDo(__FUNCTION__, $country->entityName);
    }

    /**
     * Determine whether the user can restore the country.
     *
     * @param User $user
     * @param Country $country
     * @return mixed
     */
    public function restore(User $user, Country $country)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can permanently delete the country.
     *
     * @param User $user
     * @param Country $country
     * @return mixed
     */
    public function forceDelete(User $user, Country $country)
    {
        return config('user-actions.default-value-if-null');
    }
}
