<?php

namespace App\Policies;

use App\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any countries.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the country.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Country  $country
     * @return mixed
     */
    public function view(User $user, Country $country)
    {
        return true;
    }

    /**
     * Determine whether the user can create countries.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can update the country.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Country  $country
     * @return mixed
     */
    public function update(User $user, Country $country)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the country.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Country  $country
     * @return mixed
     */
    public function delete(User $user, Country $country)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the country.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Country  $country
     * @return mixed
     */
    public function restore(User $user, Country $country)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the country.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Country  $country
     * @return mixed
     */
    public function forceDelete(User $user, Country $country)
    {
        return false;
    }
}
