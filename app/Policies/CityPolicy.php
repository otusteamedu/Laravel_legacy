<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cities.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can view the city.
     *
     * @param User $user
     * @param City $city
     * @return mixed
     */
    public function view(User $user, City $city)
    {
        return $user->canDo(__FUNCTION__, $city->entityName);
    }

    /**
     * Determine whether the user can create cities.
     *
     * @param User $user
     * @param City $city
     * @return mixed
     */
    public function create(User $user, City $city)
    {
        return $user->canDo(__FUNCTION__, $city->entityName);
    }

    /**
     * Determine whether the user can update the city.
     *
     * @param User $user
     * @param City $city
     * @return mixed
     */
    public function update(User $user, City $city)
    {
        return $user->canDo(__FUNCTION__, $city->entityName);
    }

    /**
     * Determine whether the user can delete the city.
     *
     * @param User $user
     * @param City $city
     * @return mixed
     */
    public function delete(User $user, City $city)
    {
        return $user->canDo(__FUNCTION__, $city->entityName);
    }

    /**
     * Determine whether the user can restore the city.
     *
     * @param User $user
     * @param City $city
     * @return mixed
     */
    public function restore(User $user, City $city)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can permanently delete the city.
     *
     * @param User $user
     * @param City $city
     * @return mixed
     */
    public function forceDelete(User $user, City $city)
    {
        return config('user-actions.default-value-if-null');
    }
}
