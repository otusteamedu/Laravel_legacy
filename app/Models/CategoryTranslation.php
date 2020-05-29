<?php

namespace App\Models;

/**
 * App\Models\CategoryTranslation
 *
 * @property int $id
 * @property int $category_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereLocale($value)
 */
class CategoryTranslation extends Model
{
    protected $fillable = [
        'category_id',
        'locale',
        'attribute',
        'value'
    ];
}
