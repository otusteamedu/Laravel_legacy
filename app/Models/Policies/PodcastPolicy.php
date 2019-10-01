<?php

namespace App\Models\Policies;

use App\User;
use App\Models\Podcast;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

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
            ? Response::allow()
            : Response::deny(trans('podcast.no_access'));
    }
}
