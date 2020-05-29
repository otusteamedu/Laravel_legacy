<?php

namespace App\Models;

/**
 * App\Models\ColorTranslation
 *
 * @property int $id
 * @property int $color_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ColorTranslation whereLocale($value)
 */
class ColorTranslation extends Model
{
    protected $fillable = [
        'color_id',
        'locale',
        'attribute',
        'value'
    ];
}
