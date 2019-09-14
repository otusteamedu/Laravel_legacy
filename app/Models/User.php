<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property Location locations
 * @property Workout workouts
 * @property Role roles
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function locations()
    {
        return $this->hasMany('App\Models\Location');
    }

    public function workouts()
    {
        return $this->hasMany('App\Models\Workout');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')
            ->using('App\Models\RoleUser');
    }

}
