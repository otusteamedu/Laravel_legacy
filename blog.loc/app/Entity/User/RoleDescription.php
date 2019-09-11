<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;

class RoleDescription extends Model
{
    protected $table = 'role_description';
    protected $fillable = [
        'lang', 'role_id', 'title', 'description'
    ];

    public function role()
    {
        return $this->belongsTo('App\Entity\User\Role');
    }
}
