<?php

namespace App\Models\Translations;

/**
 * App\Models\Translations\CategoryGroupTranslation
 *
 * @property int $id
 * @property int $category_group_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation whereCategoryGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CategoryGroupTranslation whereLocale($value)
 */
class CategoryGroupTranslation extends Translation
{
    protected $fillable = [
        'category_group_id',
        'locale',
        'attribute',
        'value'
    ];
}
