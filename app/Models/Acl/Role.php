<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "acl_roles";

    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'acl_permission_acl_role', 'acl_role_id', 'acl_permission_id');
    }
}
