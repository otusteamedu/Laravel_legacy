<?php

namespace App\Models\Policies;

use App\User;
use App\Models\Episode;
use Illuminate\Auth\Access\HandlesAuthorization;

class EpisodePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the podcast.
     *
     * @param \App\User $user
     * @param \App\Models\Episode $episode
     * @return mixed
     */
    public function access(User $user, Episode $episode)
    {
        return $episode->hasUser($user)
            ? $this->allow()
            : $this->deny(trans('common.no_access'));
    }
}
