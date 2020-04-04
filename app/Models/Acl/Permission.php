<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "acl_permissions";

    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'acl_role_acl_permissions', 'acl_permission_id', 'acl_role_id');
    }
}
