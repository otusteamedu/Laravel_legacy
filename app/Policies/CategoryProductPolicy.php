<?php

namespace App\Policies;

use App\Models\CategoryProduct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryProductPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * Determine whether the user can view any category products.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can view the category product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return mixed
     */
    public function view(User $user, CategoryProduct $categoryProduct)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can create category products.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isModerator();
    }

    public function edit(User $user, CategoryProduct $categoryProduct)
    {
        return $user->id == $categoryProduct->created_user_id;
    }

    /**
     * Determine whether the user can update the category product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return mixed
     */
    public function update(User $user, CategoryProduct $categoryProduct)
    {
        return $user->id == $categoryProduct->created_user_id;
    }

    /**
     * Determine whether the user can delete the category product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return mixed
     */
    public function delete(User $user, CategoryProduct $categoryProduct)
    {
        return $user->id == $categoryProduct->created_user_id;
    }

    /**
     * Determine whether the user can restore the category product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return mixed
     */
    public function restore(User $user, CategoryProduct $categoryProduct)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the category product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return mixed
     */
    public function forceDelete(User $user, CategoryProduct $categoryProduct)
    {
        return $user->id == $categoryProduct->created_user_id;
    }
}
