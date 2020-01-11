<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
