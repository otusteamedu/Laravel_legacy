<?php

namespace App\Models\Acl;

use App\Models\BaseModel;

/**
 * App\Models\Acl\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property string $scope
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Acl\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission whereScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Acl\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Acl\Role[] $rols
 * @property-read int|null $rols_count
 */
class Permission extends BaseModel
{
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function rols() {
        return $this->belongsToMany(Role::class);
    }
}
