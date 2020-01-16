<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WishlistProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishlistProductPolicy
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
     * Determine whether the user can delete the wishlist.
     *
     * @param  User  $user
     * @param  WishlistProduct  $wishlistProduct
     *
     * @return mixed
     */
    public function delete(User $user, WishlistProduct $wishlistProduct)
    {
        if ($user->id === $wishlistProduct->getUserId()) {
            return true;
        }
    }

}
