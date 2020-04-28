<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } else if ($user->isKaznachey()) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Determine whether the user can view any transactions.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the transaction.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Transaction $transaction
     * @return mixed
     */
    public function view(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can create transactions.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the transaction.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Transaction $transaction
     * @return mixed
     */
    public function update(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can delete the transaction.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Transaction $transaction
     * @return mixed
     */
    public function delete(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can restore the transaction.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Transaction $transaction
     * @return mixed
     */
    public function restore(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the transaction.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Transaction $transaction
     * @return mixed
     */
    public function forceDelete(User $user, Transaction $transaction)
    {
        //
    }
}
