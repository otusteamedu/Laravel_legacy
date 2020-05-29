<?php

namespace App\Models;

/**
 * App\Models\RoleTranslation
 *
 * @property int $id
 * @property int $role_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleTranslation whereLocale($value)
 */
class RoleTranslation extends Model
{
    protected $fillable = [
        'role_id',
        'locale',
        'attribute',
        'value'
    ];
}
