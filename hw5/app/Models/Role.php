<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 * @property int id
 * @property string name
 * @property timestamp created_at
 * @property timestamp updated_id
 */
class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User', 'user_role');
    }
    public function permissions(){
        return $this->belongsToMany('App\Models\Permission', 'role_permissions', 'role_id', 'permission_id');
    }



}
