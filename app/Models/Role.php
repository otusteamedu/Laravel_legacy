<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    const LEVEL_ROOT = 'root';
    const LEVEL_ADMIN = 'admin';
    const LEVEL_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type'
    ];

    public function user(){
        return $this->hasMany('App\Models\User');
    }

}
