<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
    ];
    public function roles(){
       return $this->belongsToMany('App\Models\Role', 'role_permissions', 'permission_id', 'role_id');
   }
}
