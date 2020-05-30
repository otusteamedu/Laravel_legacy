<?php

namespace App\Models\Translations;

/**
 * App\Models\Translations\MaterialTranslation
 *
 * @property int $id
 * @property int $material_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MaterialTranslation whereLocale($value)
 */
class MaterialTranslation extends Translation
{
    protected $fillable = [
        'material_id',
        'locale',
        'attribute',
        'value'
    ];
}
