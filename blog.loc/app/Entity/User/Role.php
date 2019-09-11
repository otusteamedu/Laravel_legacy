<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'slug', 'status', 'order',
    ];

    public function roleDescriptions()
    {
        return $this->hasMany('App\Entity\User\Role', 'role_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\Entity\User\User', 'role_id', 'id');
    }
}
