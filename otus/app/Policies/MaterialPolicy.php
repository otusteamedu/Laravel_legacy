<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any materials.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Material $material
     * @return mixed
     */
    public function view(User $user, Material $material) {
        return true;
    }

    /**
     * Determine whether the user can create materials.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can update the material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Material $material
     * @return mixed
     */
    public function update(User $user, Material $material) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can delete the material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Material $material
     * @return mixed
     */
    public function delete(User $user, Material $material) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can restore the material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Material $material
     * @return mixed
     */
    public function restore(User $user, Material $material) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can permanently delete the material.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Material $material
     * @return mixed
     */
    public function forceDelete(User $user, Material $material) {
        return false;
    }
}
