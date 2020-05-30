<?php

namespace App\Models\Translations;

/**
 * App\Models\Translations\CategoryTranslation
 *
 * @property int $id
 * @property int $category_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryTranslation whereLocale($value)
 */
class CategoryTranslation extends Translation
{
    protected $fillable = [
        'category_id',
        'locale',
        'attribute',
        'value'
    ];
}
