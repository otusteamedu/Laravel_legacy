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
        return $this->belongsToMany('App\Models\Permission', 'role_permissions');

    }
    public function hasPermission($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->permissions as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    public function savePermissions($inputPermissions)
    {

        if(!empty($inputPermissions)) {
            $this->permissions()->sync($inputPermissions);
        }
        else {
            $this->permissions()->detach();
        }

        return TRUE;
    }



}
