<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
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
     *
     * @return bool
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * @param  User  $user
     * @param  Product  $product
     */
    public function update(User $user, Product $product)
    {
        //
    }

    /**
     * @param  User  $user
     *
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * @param  User  $user
     * @param  Product  $product
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * @param  User  $user
     * @param  Product  $product
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
