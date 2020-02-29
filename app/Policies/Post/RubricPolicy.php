<?php

namespace App\Policies\Post;

use App\Models\User\User;
use App\Policies\AuthorizationChecker;
use App\Repositories\User\Right\RightRepository;
use App\Models\Post\Rubric;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Настройка прав для модуля рубрики
 * Class RubricPolicy
 * @package App\Policies\Post
 */
class RubricPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any rubrics.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::POSTS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::RUBRIC_LIST);
    }

    /**
     * Determine whether the user can view the rubric.
     *
     * @param User $user
     * @param Rubric  $rubric
     * @return mixed
     */
    public function view(User $user, Rubric $rubric)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::POSTS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::RUBRIC_LIST);
    }

    /**
     * Determine whether the user can create rubrics.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::POSTS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::RUBRIC_CREATE);
    }

    /**
     * Determine whether the user can update the rubric.
     *
     * @param User $user
     * @param Rubric  $rubric
     * @return mixed
     */
    public function update(User $user, Rubric $rubric)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::POSTS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::RUBRIC_CREATE);
    }

    /**
     * Determine whether the user can delete the rubric.
     *
     * @param User $user
     * @param Rubric  $rubric
     * @return mixed
     */
    public function delete(User $user, Rubric $rubric)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::POSTS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::RUBRIC_CREATE);
    }

    /**
     * Determine whether the user can restore the rubric.
     *
     * @param User $user
     * @param Rubric  $rubric
     * @return mixed
     */
    public function restore(User $user, Rubric $rubric)
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::POSTS)
            && AuthorizationChecker::hasUserRight($user, RightRepository::RUBRIC_CREATE);
    }

    /**
     * Determine whether the user can permanently delete the rubric.
     *
     * @param User $user
     * @param Rubric  $rubric
     * @return mixed
     */
    public function forceDelete(User $user, Rubric $rubric)
    {
        return false;
    }
}
