<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
