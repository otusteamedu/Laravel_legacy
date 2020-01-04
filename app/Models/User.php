<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @property  int role_id
 * @property string name
 * @property string email
 * @property string password
 * @property  int id
 */
class User extends Authenticatable
{
    use Notifiable;


    const LEVEL_ADMIN = 1;
    const LEVEL_MANAGER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin(): bool
    {
        return $this->role_id === self::LEVEL_ADMIN;
    }

    public function isManager(): bool
    {
        return $this->role_id === self::LEVEL_MANAGER;
    }

    public function isAuthor($post) :bool
    {
        return $this->id === $post;
    }
}
