<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class BaseAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdminBreadcrumbs()
    {

        $breadcrumbs = [
            [
                'url' => route('admin.index'),
                'title' => __('messages.admin_panel'),
            ],

        ];

        return $breadcrumbs;
    }
    public function checkCurrentUserRouteAccess(User $user, $routeName){

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
