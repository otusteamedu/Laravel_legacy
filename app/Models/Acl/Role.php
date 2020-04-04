<?php

namespace App\Models\Acl;

use App\Models\BaseModel;

/**
 * App\Models\Acl\Role
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Acl\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends BaseModel
{
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }
}
