<?php

namespace App\Models\Admin\UserManagment;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $guarded=[];

    protected $defaultRole = 2;//Простой пользователь

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user', 'role_id', 'user_id');
    }

    public function getDefaultRole()
    {
        return $this->defaultRole;
    }
}
