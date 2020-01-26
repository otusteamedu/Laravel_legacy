<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the comment.
     *
     * @param  User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->author_id;
    }
}
