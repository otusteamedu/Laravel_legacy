<?php

namespace App\Policies;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any favorites.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the favorite.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Favorite $favorite
     * @return mixed
     */
    public function view(User $user, Favorite $favorite) {
        return $user->id === $favorite->user_id;
    }

    /**
     * Determine whether the user can create favorites.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        return true;
    }

    /**
     * Determine whether the user can update the favorite.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Favorite $favorite
     * @return mixed
     */
    public function update(User $user, Favorite $favorite) {
        return $user->id === $favorite->user_id;
    }

    /**
     * Determine whether the user can delete the favorite.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Favorite $favorite
     * @return mixed
     */
    public function delete(User $user, Favorite $favorite) {
        return $user->id === $favorite->user_id;
    }

    /**
     * Determine whether the user can restore the favorite.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Favorite $favorite
     * @return mixed
     */
    public function restore(User $user, Favorite $favorite) {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the favorite.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Favorite $favorite
     * @return mixed
     */
    public function forceDelete(User $user, Favorite $favorite) {
        return false;
    }
}
