<?php

namespace App\Policies;

use App\Models\Tariff;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TariffPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tariffs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can view the tariff.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tariff  $tariff
     * @return mixed
     */
    public function view(User $user, Tariff $tariff)
    {
        return $user->canDo(__FUNCTION__, $tariff->entityName);
    }

    /**
     * Determine whether the user can create tariffs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, Tariff $tariff)
    {
        return $user->canDo(__FUNCTION__, $tariff->entityName);
    }

    /**
     * Determine whether the user can update the tariff.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tariff  $tariff
     * @return mixed
     */
    public function update(User $user, Tariff $tariff)
    {
        return $user->canDo(__FUNCTION__, $tariff->entityName);
    }

    /**
     * Determine whether the user can delete the tariff.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tariff  $tariff
     * @return mixed
     */
    public function delete(User $user, Tariff $tariff)
    {
        return $user->canDo(__FUNCTION__, $tariff->entityName);
    }

    /**
     * Determine whether the user can restore the tariff.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tariff  $tariff
     * @return mixed
     */
    public function restore(User $user, Tariff $tariff)
    {
        return config('user-actions.default-value-if-null');
    }

    /**
     * Determine whether the user can permanently delete the tariff.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tariff  $tariff
     * @return mixed
     */
    public function forceDelete(User $user, Tariff $tariff)
    {
        return config('user-actions.default-value-if-null');
    }
}
