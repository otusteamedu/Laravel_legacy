<?php

namespace App\Models\Translations;

/**
 * App\Models\Translations\RoleTranslation
 *
 * @property int $id
 * @property int $role_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\RoleTranslation whereLocale($value)
 */
class RoleTranslation extends Translation
{
    protected $fillable = [
        'role_id',
        'locale',
        'attribute',
        'value'
    ];
}
