<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

/**
 * Class Permission
 * @package App\Models
 * @property int id
 * @property string name
 * @property timestamp created_at
 * @property timestamp updated_id
 */
class Permission extends Model
{
    protected $fillable = [
        'name', 'route'
    ];
    public function roles(){

       return $this->belongsToMany('App\Models\Role', 'role_permissions');
   }
}
