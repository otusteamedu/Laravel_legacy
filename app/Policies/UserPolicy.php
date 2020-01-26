<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->isAdmin();
    }
}
