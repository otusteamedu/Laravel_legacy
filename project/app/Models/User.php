<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /** @var int default user */
    public const LEVEL_USER = 1;
    /** @var int user who can edit action's data */
    public const LEVEL_MODERATOR = 2;
    /** @var int can do everything */
    public const LEVEL_ADMIN = 3;

    public const LEVEL_USER_TITLE = 'Обычный пользователь';
    public const LEVEL_MODERATOR_TITLE = 'Модератор';
    public const LEVEL_ADMIN_TITLE = 'Администратор';

    public $roles = [
        self::LEVEL_USER      => self::LEVEL_USER_TITLE,
        self::LEVEL_MODERATOR => self::LEVEL_MODERATOR_TITLE,
        self::LEVEL_ADMIN     => self::LEVEL_ADMIN_TITLE,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level'
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

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->level === self::LEVEL_ADMIN;
    }

    /**
     * @return bool
     */
    public function isModerator(): bool
    {
        return $this->level === self::LEVEL_MODERATOR;
    }
}
