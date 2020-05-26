<?php

namespace App\Models;

/**
 * App\Models\ProductTranslation
 *
 * @property int $id
 * @property int $product_id
 * @property string $locale
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductTranslation whereValue($value)
 * @mixin \Eloquent
 */
class ProductTranslation extends Model
{
    protected $fillable = [
        'product_id',
        'locale',
        'attribute',
        'value'
    ];
}
