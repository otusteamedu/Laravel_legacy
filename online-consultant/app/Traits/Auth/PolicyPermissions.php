<?php

namespace App\Traits\Auth;

use App\Models\Permission;
use App\Models\User;
use App\Policies\Abilities;

trait PolicyPermissions
{
    /**
     * Get permission name for ability from current model
     *
     * @param  string  $ability
     *
     * @return string
     */
    public function getPermission(string $ability): string
    {
        return Permission::makeNameFromAbility($ability, $this->modelClass);
    }
    
    /**
     * Check if user has permission for ability
     *
     * @param  User  $user
     * @param  string  $ability
     *
     * @return bool
     */
    public function userCan(User $user, string $ability): bool
    {
        return $user->can($this->getPermission($ability));
    }
    
    /**
     * Check if user doesn't have permission for ability
     *
     * @param  User  $user
     * @param  string  $ability
     *
     * @return bool
     */
    public function userCannot(User $user, string $ability): bool
    {
        return !$user->can($this->getPermission($ability));
    }
    
    /**
     * Check if user has permission for manage all abilities for model
     *
     * @param  User  $user
     *
     * @return bool
     */
    public function userCanManageAny(User $user): bool
    {
        return $this->userCan($user, Abilities::MANAGE_ANY);
    }
}
