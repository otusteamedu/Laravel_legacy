<?php

namespace App\Models;

use App\Models\Student as Student;
use App\Models\Role as Role;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'role_id'
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->using(StudentUser::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }


    public function isAdmin()
    {
        if ($this->role_id == 1) {
            return TRUE;
        }
        return false;
    }

    public function isKaznachey()
    {
        if ($this->role_id == 3) {
            return TRUE;
        }
        return false;
    }

}

