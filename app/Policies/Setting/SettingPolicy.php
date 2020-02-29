<?php

namespace App\Policies\Setting;

use App\Models\User\User;
use App\Models\Setting\Setting;
use App\Policies\AuthorizationChecker;
use App\Repositories\User\Right\RightRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @todo реализовать политики настройки, когда полностью будет реализован модуль
 * Настройка прав для модуля Настройки
 * Class SettingPolicy
 * @package App\Policies
 */
class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any settings.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin()
            && AuthorizationChecker::hasUserRight($user, RightRepository::SETTINGS);
    }

    /**
     * Determine whether the user can view the setting.
     *
     * @param User $user
     * @param Setting  $setting
     * @return mixed
     */
    public function view(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can create settings.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the setting.
     *
     * @param User $user
     * @param  Setting  $setting
     * @return mixed
     */
    public function update(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can delete the setting.
     *
     * @param User $user
     * @param  Setting  $setting
     * @return mixed
     */
    public function delete(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can restore the setting.
     *
     * @param User $user
     * @param Setting  $setting
     * @return mixed
     */
    public function restore(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the setting.
     *
     * @param User $user
     * @param Setting  $setting
     * @return mixed
     */
    public function forceDelete(User $user, Setting $setting)
    {
        //
    }
}
