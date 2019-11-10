<?php

namespace App\Policies;

use App\Models\Compilation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompilationPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any compilations.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the compilation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Compilation $compilation
     * @return mixed
     */
    public function view(User $user, Compilation $compilation) {
        return true;
    }

    /**
     * Determine whether the user can create compilations.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can update the compilation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Compilation $compilation
     * @return mixed
     */
    public function update(User $user, Compilation $compilation) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can delete the compilation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Compilation $compilation
     * @return mixed
     */
    public function delete(User $user, Compilation $compilation) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can restore the compilation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Compilation $compilation
     * @return mixed
     */
    public function restore(User $user, Compilation $compilation) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can permanently delete the compilation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Compilation $compilation
     * @return mixed
     */
    public function forceDelete(User $user, Compilation $compilation) {
        return false;
    }
}
