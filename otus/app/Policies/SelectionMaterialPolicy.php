<?php

namespace App\Policies;

use App\Models\SelectionMaterial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SelectionMaterialPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any selection materials.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can view the selection material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return mixed
     */
    public function view(User $user, SelectionMaterial $selectionMaterial) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can create selection materials.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can update the selection material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return mixed
     */
    public function update(User $user, SelectionMaterial $selectionMaterial) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can delete the selection material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return mixed
     */
    public function delete(User $user, SelectionMaterial $selectionMaterial) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can restore the selection material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return mixed
     */
    public function restore(User $user, SelectionMaterial $selectionMaterial) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can permanently delete the selection material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return mixed
     */
    public function forceDelete(User $user, SelectionMaterial $selectionMaterial) {
        return false;
    }
}
