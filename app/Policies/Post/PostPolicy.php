<?php

namespace App\Policies\Post;

use App\Models\User\User;
use App\Models\Post\Post;
use App\Repositories\User\Right\RightRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Настройка прав для модуля новости
 * Class PostPolicy
 * @package App\Policies\Post
 */
class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::POST_LIST) !== false;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param User $user
     * @param  Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::POST_LIST) !== false;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::POST_CREATE) !== false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param User $user
     * @param  Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::POST_CREATE) !== false
            && $post->user_id === $user->id;
    }

    /**
     * Публикация/снятие с публикации новости
     *
     * @param User $user
     * @param  Post $post
     * @return mixed
     */
    public function published(User $user, Post $post)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::POST_PUBLISH) !== false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param User $user
     * @param  Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && (
                $user->id === $post->user_id
                || $userRights->search(RightRepository::POST_PUBLISH) !== false
            );
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param User $user
     * @param  Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && $userRights->search(RightRepository::POSTS) !== false
            && $userRights->search(RightRepository::POST_PUBLISH) !== false;
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param User $user
     * @param  Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        return false;
    }
}
