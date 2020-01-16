<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Policies;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishlistPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user
     *
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any wishlists.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * @param  User  $user
     * @param  Wishlist  $wishlist
     *
     * @return bool
     */
    public function view(User $user, Wishlist $wishlist)
    {
        if ($this->wishlistBelongsToUser($user, $wishlist)) {
            return true;
        }
    }

    /**
     * Determine whether the user can create wishlists.
     *
     * @return mixed
     */
    public function create()
    {
        return true;
    }

    /**
     * Determine whether the user can update the wishlist.
     *
     * @param  User  $user
     * @param  Wishlist  $wishlist
     *
     * @return mixed
     */
    public function update(User $user, Wishlist $wishlist)
    {
        //
    }

    /**
     * Determine whether the user can delete the wishlist.
     *
     * @param  User  $user
     * @param  Wishlist  $wishlist
     *
     * @return mixed
     */
    public function delete(User $user, Wishlist $wishlist)
    {
        if ($this->wishlistBelongsToUser($user, $wishlist)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the wishlist.
     *
     * @param  User  $user
     * @param  Wishlist  $wishlist
     *
     * @return mixed
     */
    public function restore(User $user, Wishlist $wishlist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the wishlist.
     *
     * @param  User  $user
     * @param  Wishlist  $wishlist
     *
     * @return mixed
     */
    public function forceDelete(User $user, Wishlist $wishlist)
    {
        //
    }

    /**
     * @param  User  $user
     * @param  Wishlist  $wishlist
     *
     * @return bool
     */
    protected function wishlistBelongsToUser(User $user, Wishlist $wishlist) :bool
    {
        return $user->id === $wishlist->user_id;
    }
}
