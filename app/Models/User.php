<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Проверка на роль, проверка так на скорую руку не для продакшн
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasPermission(string $permission)
    {
        return $this->permissions()->where('name', $permission)->exists()
            || $this->roles()->whereHas('permissions', function (Builder $query) use ($permission) {
                $query->where('name', $permission);
            })->exists();
    }
}
