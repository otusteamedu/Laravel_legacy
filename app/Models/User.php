<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int id
 *
 * @package App\Models
 */

class User extends Authenticatable
{
    const ROLE_ROOT = "root";
    const ROLE_ADMIN = "admin";
    const ROLE_CONTENT = "content";
    const ROLE_OPERATOR = "operator";
    const ROLE_REGISTERED = "registered";

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'password', 'birthday', 'sex',
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

    public function roles() {
        return $this
            ->belongsToMany('App\Models\Role', 'user_role')
            ->using('App\Models\UserRole');
    }

    public function isRoot(): bool {
        return $this->roles()->where(['code' => self::ROLE_ROOT])->get()->count() > 0;
    }

    public function isAdmin(): bool {
        return $this->isRoot() ||
            ($this->roles()->where(['code' => self::ROLE_ADMIN])->get()->count() > 0);
    }

    public function isOperator(): bool {
        return $this->isRoot() || $this->isAdmin() ||
            ($this->roles()->where(['code' => self::ROLE_OPERATOR])->get()->count() > 0);
    }

    public function isRegistered(): bool {
        return $this->isRoot() || $this->isAdmin() || $this->isOperator() ||
            $this->roles()->where(['code' => self::ROLE_REGISTERED])->get()->count() > 0;
    }

    public function canUseManager(): bool {
        return $this->roles()->where('code', '<>', self::ROLE_REGISTERED)->get()->count() > 0;
    }
}
