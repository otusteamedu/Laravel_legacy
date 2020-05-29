<?php

namespace App\Models;

/**
 * App\Models\CategoryGroupTranslation
 *
 * @property int $id
 * @property int $category_group_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation whereCategoryGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroupTranslation whereLocale($value)
 */
class CategoryGroupTranslation extends Model
{
    protected $fillable = [
        'category_group_id',
        'locale',
        'attribute',
        'value'
    ];
}
