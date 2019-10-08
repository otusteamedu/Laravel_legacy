<?php

namespace App\Services\Security;

use App\Models\User;

class UserPermissionChecker
{

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function canDo($permission, $allRequire = false)
    {

        if (is_array($permission)) {
            $count = 0;
            foreach ($permission as $permName) {
                $canDo = $this->canDo($permName);
                if ($canDo && !$allRequire) {
                    return true;
                } else if (!$canDo && $allRequire) {
                    return false;
                } else if (!$canDo && !$allRequire) {
                    $count++;
                }

            }
            if ($count == count($permission)) {
                return false;
            }
            return true;

        } else {
            foreach ($this->model->roles as $role) {
                foreach ($role->permissions as $perm) {
                    if (str_is($permission, $perm->name)) {
                        return true;
                    }
                }
            }
        }

    }

    public function hasRole($name, $allRequire = false)
    {

        if (is_array($name)) {
            $count = 0;
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);
                if ($hasRole && !$allRequire) {
                    return true;
                } else if (!$hasRole && $allRequire) {
                    return false;
                } else if (!$hasRole && !$allRequire) {
                    $count++;
                }

            }
            if ($count == count($name)) {
                return false;
            }
            return true;

        } else {
            foreach ($this->model->roles as $role) {
                if ($name == $role) {
                    return true;
                }

            }
        }
        return false;

    }
}

