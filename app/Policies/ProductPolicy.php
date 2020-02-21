<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * Determine whether the user can view any products.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can create products.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $user->id == $product->created_user_id;
    }

    /**
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function edit(User $user, Product $product)
    {
        return $user->id == $product->created_user_id;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $user->id == $product->created_user_id;
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        return $user->id == $product->created_user_id;
    }
}
