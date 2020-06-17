<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any events.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function view(User $user, Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        $isUpdateAllowed = $user->id === $event->id;

        return $isUpdateAllowed;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        return $user->isAdmin() || $user->isModerator() || $user->id === $event->id;;
    }

    /**
     * Determine whether the user can restore the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function restore(User $user, Event $event)
    {
        return $user->isAdmin() || $user->isModerator();
    }

    /**
     * Determine whether the user can permanently delete the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function forceDelete(User $user, Event $event)
    {
        return false;
    }
}
