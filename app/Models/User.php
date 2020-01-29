<?php

/**
 * Пользователь. Лид, если ничего не купил. Покупатель - если купил.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const LEVEL_USER = 1;
    const LEVEL_MODERATOR = 2;
    const LEVEL_ADMIN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/
    // все переменные - mass assignable, иначе не смогу сохранить поля модели User внутри UsersController@store()
    protected $guarded = [];

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

    /**
     * Get the account record associated with the user.
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account');
    }

    /**
     * Get orders for the user.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return bool is this user admin ?
     */
    public function isAdmin(): bool
    {
        return $this->level === self::LEVEL_ADMIN;
    }
}
