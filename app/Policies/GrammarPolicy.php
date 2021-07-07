<?php

namespace App\Policies;

use App\Grammar;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GrammarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any grammars.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the grammar.
     *
     * @param  \App\User  $user
     * @param  \App\Grammar  $grammar
     * @return mixed
     */
    public function view(User $user, Grammar $grammar)
    {
        //
    }

    /**
     * Determine whether the user can create grammars.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the grammar.
     *
     * @param  \App\User  $user
     * @param  \App\Grammar  $grammar
     * @return mixed
     */
    public function update(User $user, Grammar $grammar)
    {
       //
    }

    /**
     * Determine whether the user can delete the grammar.
     *
     * @param  \App\User  $user
     * @param  \App\Grammar  $grammar
     * @return mixed
     */
    public function delete(User $user, Grammar $grammar)
    {
        //
    }

    /**
     * Determine whether the user can restore the grammar.
     *
     * @param  \App\User  $user
     * @param  \App\Grammar  $grammar
     * @return mixed
     */
    public function restore(User $user, Grammar $grammar)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the grammar.
     *
     * @param  \App\User  $user
     * @param  \App\Grammar  $grammar
     * @return mixed
     */
    public function forceDelete(User $user, Grammar $grammar)
    {
        //
    }
}
