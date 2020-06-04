<?php

namespace App\Policies;

use App\Models\ArticleComment;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleCommentPolicy
{
    use HandlesAuthorization;

    //TODO: комментарии еще не реализованы, политика на будущее
    public function before(User $user)
    {
        if ($user->group->name == UserGroup::ADMIN_GROUP) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArticleComment  $articleComment
     * @return mixed
     */
    public function view(User $user, ArticleComment $articleComment)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !in_array($user->group->name, [UserGroup::BLOCKED_GROUP]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArticleComment  $articleComment
     * @return mixed
     */
    public function update(User $user, ArticleComment $articleComment)
    {
        switch ($user->group->name) {
            case UserGroup::REGISTERED_GROUP:
            case UserGroup::EDITOR_GROUP:
            case UserGroup::AUTHOR_GROUP:
                return $articleComment->user_id === $user->id;
                break;
            case UserGroup::MODERATOR_GROUP:
                return true;
                break;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArticleComment  $articleComment
     * @return mixed
     */
    public function delete(User $user, ArticleComment $articleComment)
    {
        switch ($user->group->name) {
            case UserGroup::REGISTERED_GROUP:
            case UserGroup::EDITOR_GROUP:
            case UserGroup::AUTHOR_GROUP:
                return $articleComment->user_id === $user->id;
                break;
            case UserGroup::MODERATOR_GROUP:
                return true;
                break;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArticleComment  $articleComment
     * @return mixed
     */
    public function restore(User $user, ArticleComment $articleComment)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArticleComment  $articleComment
     * @return mixed
     */
    public function forceDelete(User $user, ArticleComment $articleComment)
    {
        return false;
    }
}
