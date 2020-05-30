<?php

namespace App\Models\Translations;

/**
 * App\Models\Translations\ColorTranslation
 *
 * @property int $id
 * @property int $color_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ColorTranslation whereLocale($value)
 */
class ColorTranslation extends Translation
{
    protected $fillable = [
        'color_id',
        'locale',
        'attribute',
        'value'
    ];
}
