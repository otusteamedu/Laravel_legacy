<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role_id','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function isRoot(){
        return $this->role->type === Role::LEVEL_ROOT;
    }

    public function isAdmin(){
        return $this->role->type === Role::LEVEL_ADMIN;
    }

    public function isUser(){
        return $this->role->type === Role::LEVEL_USER;
    }
}
