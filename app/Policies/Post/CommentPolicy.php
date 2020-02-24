<?php

namespace App\Policies\Post;

use App\Models\Post\Comment;
use App\Models\User\User;
use App\Repositories\User\Right\RightRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Настройка прав для модуля комментарии
 * Class CommentPolicy
 * @package App\Policies\Post
 */
class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any comments.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::COMMENT_LIST) !== false;
    }

    /**
     * Determine whether the user can view the comment.
     *
     * @param User $user
     * @param Comment $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::COMMENT_LIST) !== false;
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param User $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id
            && $comment->is_published === false;
    }

    /**
     * Публикация/снятие с публикации комментария
     *
     * @param User $user
     * @param  Comment $comment
     * @return mixed
     */
    public function published(User $user, Comment $comment)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
        && $userRights->search(RightRepository::POSTS) !== false
        && $userRights->search(RightRepository::COMMENT_PUBLISH) !== false;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param User $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->id === $comment->user_id
            || ($user->isAdmin()
                && $userRights->search(RightRepository::POSTS) !== false
                && $userRights->search(RightRepository::COMMENT_PUBLISH) !== false
            );
    }

    /**
     * Determine whether the user can restore the comment.
     *
     * @param User $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::COMMENT_PUBLISH) !== false;
    }

    /**
     * Determine whether the user can permanently delete the comment.
     *
     * @param User $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        return false;
    }
}
