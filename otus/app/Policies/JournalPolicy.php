<?php

namespace App\Policies;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JournalPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any journals.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the journal.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Journal $journal
     * @return mixed
     */
    public function view(User $user, Journal $journal) {
        return true;
    }

    /**
     * Determine whether the user can create journals.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        return true;
    }

    /**
     * Determine whether the user can update the journal.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Journal $journal
     * @return mixed
     */
    public function update(User $user, Journal $journal) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can delete the journal.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Journal $journal
     * @return mixed
     */
    public function delete(User $user, Journal $journal) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can restore the journal.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Journal $journal
     * @return mixed
     */
    public function restore(User $user, Journal $journal) {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can permanently delete the journal.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Journal $journal
     * @return mixed
     */
    public function forceDelete(User $user, Journal $journal) {
        return false;
    }
}
