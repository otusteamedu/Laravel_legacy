<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;



class AuthService
{
    public function checkCurrentUserRouteAccess(User $user, $routeName)
    {

        if ($this->hasPermission($user, $routeName) || $this->hasPermission($user, 'admin.index')) {
            return true;
        }
        return false;
    }

    public function hasPermissions(User $user, $routes, $require = false)
    {
        if (is_array($routes)) {
            foreach ($routes as $route) {
                $hasPermission = $this->hasPermission($user, $route);
                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        }
        else {
            return  $this->hasPermission($user, $routes);
        }


    }


    public function hasPermission(User $user,  $route)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->route == $route) {
                    return true;
                }
            }
        }
        return false;
    }
}