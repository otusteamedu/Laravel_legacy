<?php

namespace App\Policies;

use App\Models\Products;
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
     * Determine whether the user can view the products.
     *
     * @param  User  $user
     * @param  \App\Models\Products  $products
     *
     * @return mixed
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
     * Determine whether the user can update the products.
     *
     * @param  User  $user
     * @param  \App\Models\Products  $products
     *
     * @return mixed
     */
    public function update(User $user, Products $products)
    {
        //
    }

    /**
     * Determine whether the user can delete the products.
     *
     * @param  User  $user
     * @param  \App\Models\Products  $products
     *
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the products.
     *
     * @param  User  $user
     * @param  \App\Models\Products  $products
     *
     * @return mixed
     */
    public function restore(User $user, Products $products)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the products.
     *
     * @param  User  $user
     * @param  \App\Models\Products  $products
     *
     * @return mixed
     */
    public function forceDelete(User $user, Products $products)
    {
        //
    }
}
