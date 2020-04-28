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
    const PERMISSION_ALL = 1;
    const PERMISSION_ALL_ROUTE = 'admin.index';


    protected $fillable = [
        'name', 'route', 'id'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_permissions');
    }
}
