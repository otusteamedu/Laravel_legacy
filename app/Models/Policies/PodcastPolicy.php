<?php

namespace App\Models\Policies;

use App\User;
use App\Models\Podcast;
use Illuminate\Auth\Access\HandlesAuthorization;

class PodcastPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the podcast.
     *
     * @param \App\User $user
     * @param \App\Models\Podcast $podcast
     * @return mixed
     */
    public function access(User $user, Podcast $podcast)
    {
        return $podcast->hasUser($user)
            ? $this->allow()
            : $this->deny(trans('common.no_access'));
    }
}
