<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    protected $entity = 'city';

    /**
     * Determine whether the user can view any cities.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the city.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function view(User $user, City $city)
    {
        dd('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));
    }

    /**
     * Determine whether the user can create cities.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));
    }

    /**
     * Determine whether the user can update the city.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function update(User $user, City $city)
    {
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));
    }

    /**
     * Determine whether the user can delete the city.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function delete(User $user, City $city)
    {
        return config('user-actions.'.$user->role.'.'.__FUNCTION__.'-'.$this->entity, config('user-actions.default-value-if-null'));
    }

    /**
     * Determine whether the user can restore the city.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function restore(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the city.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function forceDelete(User $user, City $city)
    {
        //
    }
}
