<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 *
 * @property User users
 */
class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\Models\User')
            ->using('App\Models\RoleUser');
    }
}
