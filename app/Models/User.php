<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int id
 * @property string name
 * @property string surname
 * @property string email
 * @property string password
 * @property string sex
 * @property string phone
 * @property int file_id
 * @property \Illuminate\Support\Carbon birthday
 * @property bool active
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property Role[]|\Illuminate\Database\Eloquent\Collection roles
 * @property File file
 *
 * @package App\Models
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
        'name', 'surname', 'email', 'phone', 'password', 'birthday', 'sex', 'active'
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
        return $this->roles()->where(['code' => Role::ROLE_ROOT])->get()->count() > 0;
    }

    public function isAdmin(): bool {
        return $this->isRoot() ||
            ($this->roles()->where(['code' => Role::ROLE_ADMIN])->get()->count() > 0);
    }

    public function isOperator(): bool {
        return $this->isRoot() || $this->isAdmin() ||
            ($this->roles()->where(['code' => Role::ROLE_OPERATOR])->get()->count() > 0);
    }

    public function isRegistered(): bool {
        return $this->isRoot() || $this->isAdmin() || $this->isOperator() ||
            $this->roles()->where(['code' => Role::ROLE_REGISTERED])->get()->count() > 0;
    }

    public function canUseManager(): bool {
        return $this->isActive() &&
            $this->roles()->where('code', '<>', Role::ROLE_REGISTERED)->get()->count() > 0;
    }

    public function isActive(): bool {
        return $this->active;
    }
    public function fullName(): string {
        return trim($this->surname . ' ' . $this->name);
    }
}
