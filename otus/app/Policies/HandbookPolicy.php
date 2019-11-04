<?php

namespace App\Policies;

use App\Models\Handbook;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HandbookPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any handbooks.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can view the handbook.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Handbook $handbook
     * @return mixed
     */
    public function view(User $user, Handbook $handbook) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can create handbooks.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can update the handbook.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Handbook $handbook
     * @return mixed
     */
    public function update(User $user, Handbook $handbook) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can delete the handbook.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Handbook $handbook
     * @return mixed
     */
    public function delete(User $user, Handbook $handbook) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can restore the handbook.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Handbook $handbook
     * @return mixed
     */
    public function restore(User $user, Handbook $handbook) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can permanently delete the handbook.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Handbook $handbook
     * @return mixed
     */
    public function forceDelete(User $user, Handbook $handbook) {
        return false;
    }
}
