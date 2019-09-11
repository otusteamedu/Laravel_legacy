<?php

namespace App\Entity\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email', 'password', 'status', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
