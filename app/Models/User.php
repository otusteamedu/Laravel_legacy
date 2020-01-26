<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Watson\Rememberable\Rememberable;

class User extends Authenticatable
{
    use Notifiable, Rememberable;

    const IS_ADMIN = 'admin';
    const IS_USER = 'user';

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

    public function operations()
    {
        return $this->hasMany('App\Models\Operation');
    }

    public function review()
    {
        return $this->hasOne('App\Models\Review');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'users_roles', 'user_id', 'role_id');
    }

    /**
     * Проверка принадлежит ли пользователь к какой либо роли
     *
     * @return boolean
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    /**
     * Проверка имеет ли пользователь определенную роль
     *
     * @param $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return in_array($roleName, Arr::pluck($this->roles->toArray(), 'name'));
    }

    /**
     * Получение идентификатора роли
     *
     * @param $array
     * @param $term
     * @return bool|int|string
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key + 1;
            }
        }
        return false;
    }

    /**
     * Добавление роли пользователю
     *
     * @param $title
     */
    public function makeEmployee($title)
    {
        $assigned_roles = [];
        $roles =  Arr::pluck(Role::all()->toArray(), 'name');
        switch ($title) {
            case self::IS_ADMIN:
                $assigned_roles[] = $this->getIdInArray($roles, self::IS_ADMIN);
                break;
            case self::IS_USER:
                $assigned_roles[] = $this->getIdInArray($roles, self::IS_USER);
                break;
            default:
                $assigned_roles[] = false;
        }
        $this->roles()->attach($assigned_roles);
    }
}
