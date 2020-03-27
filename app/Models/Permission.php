<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
