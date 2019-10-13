<?php

namespace App\Policies;

use App\Stock;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any stocks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the stock.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function view(User $user, Stock $stock)
    {
        //
    }

    /**
     * Determine whether the user can create stocks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->isAdmin() || $user->isModerator());
    }

    /**
     * Determine whether the user can update the stock.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function update(User $user, Stock $stock)
    {
        return ($user->isAdmin() || $user->isModerator());
    }

    /**
     * Determine whether the user can delete the stock.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function delete(User $user, Stock $stock)
    {
        return ($user->isAdmin() || $user->isModerator());
    }

    /**
     * Determine whether the user can restore the stock.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function restore(User $user, Stock $stock)
    {
        return ($user->isAdmin() || $user->isModerator());
    }

    /**
     * Determine whether the user can permanently delete the stock.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function forceDelete(User $user, Stock $stock)
    {
        //
    }
}
