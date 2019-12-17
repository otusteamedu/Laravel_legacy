<?php

namespace App\Models;

/**
 * App\Models\ProductsSnapshot
 *
 * @property int $id
 * @property int $productId
 * @property string $originalPrice
 * @property string $salePrice
 * @property string $localPrice
 * @property string $discount
 * @property string $validTime
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereLocalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereValidTime($value)
 * @mixin \Eloquent
 */
class ProductsSnapshot extends BaseModel
{
    protected $primaryKey = 'productId';
}
