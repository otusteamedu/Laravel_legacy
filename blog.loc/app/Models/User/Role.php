<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role', 'description'];

    public function users()
    {
        return $this->hasMany('App\Models\User\User','role_id', 'id');
    }
}
