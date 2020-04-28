<?php

namespace App\Models;

use App\Models\Student as Student;
use App\Models\Role as Role;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'api_token'
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
        return $this->belongsToMany(Role::class)->using(RoleUser::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->using(StudentUser::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }




    public function isAdmin(){

        foreach ($this->roles as $role) {
            if ($role->id == 1) {
                return TRUE;
            }
        }
        return false;
    }

    public function isKaznachey(){
        foreach ($this->roles as $role) {
            if ($role->id == 3) {
                return TRUE;
            }
        }
        return false;
    }

}

