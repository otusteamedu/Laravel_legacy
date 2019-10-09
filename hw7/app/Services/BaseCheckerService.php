<?php
namespace App\Services;

use App\Models\User;

class BaseCheckerService
{
    public function view(User $user, $routeName){

        if (!$this->hasPermission($user, $routeName) && !$this->hasPermission($user, 'admin.index')) {
            abort(403);
        }
    }

    public function hasPermission(User $user, $name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasPermission = $this->hasPermission($roleName);

                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($user->roles as $role) {

                foreach ($role->permissions as $permission) {

                    if ($permission->route == $name) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

}