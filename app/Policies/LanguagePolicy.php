<?php

namespace App\Policies;

use App\Models\Language;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any languages.
     *
     * @param \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the language.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Language  $language
     * @return mixed
     */
    public function view(User $user, Language $language)
    {
        return true;
    }

    /**
     * Determine whether the user can create languages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can update the language.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Language  $language
     * @return mixed
     */
    public function update(User $user, Language $language)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the language.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Language  $language
     * @return mixed
     */
    public function delete(User $user, Language $language)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the language.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Language  $language
     * @return mixed
     */
    public function restore(User $user, Language $language)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the language.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Language  $language
     * @return mixed
     */
    public function forceDelete(User $user, Language $language)
    {
        return false;
    }
}
