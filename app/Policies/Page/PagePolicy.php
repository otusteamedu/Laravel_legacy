<?php

namespace App\Policies\Page;

use App\Models\User\User;
use App\Models\Page\Page;
use App\Repositories\User\Right\RightRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Настройка прав для модуля страницы
 * Class PagePolicy
 * @package App\Policies\Page
 */
class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pages.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin()
            && $user->group->rights->pluck('right', 'id')->search(RightRepository::PAGES) !== false;
    }

    /**
     * Determine whether the user can view the page.
     *
     * @param User $user
     * @param  Page  $page
     * @return mixed
     */
    public function view(User $user, Page $page)
    {
        return $user->isAdmin()
            && $user->group->rights->pluck('right', 'id')->search(RightRepository::PAGES) !== false;
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin()
            && $user->group->rights->pluck('right', 'id')->search(RightRepository::PAGES) !== false;
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param User $user
     * @param  Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        return $user->isAdmin()
            && $user->group->rights->pluck('right', 'id')->search(RightRepository::PAGES) !== false;
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param User $user
     * @param  Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        return $user->isAdmin()
            && $user->group->rights->pluck('right', 'id')->search(RightRepository::PAGES) !== false;
    }

    /**
     * Determine whether the user can restore the page.
     *
     * @param User $user
     * @param  Page  $page
     * @return mixed
     */
    public function restore(User $user, Page $page)
    {
        return $user->isAdmin()
            && $user->group->rights->pluck('right', 'id')->search(RightRepository::PAGES) !== false;
    }

    /**
     * Determine whether the user can permanently delete the page.
     *
     * @param User $user
     * @param  Page  $page
     * @return mixed
     */
    public function forceDelete(User $user, Page $page)
    {
        return false;
    }
}
