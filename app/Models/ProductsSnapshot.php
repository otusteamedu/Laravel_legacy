<?php

namespace App\Models;

/**
 * App\Models\ProductsSnapshot
 *
 * @property int $productId
 * @property string $productTitle
 * @property string $productUrl
 * @property string $imageUrl
 * @property string $originalPrice
 * @property string $salePrice
 * @property string $discount
 * @property int $evaluateScore
 * @property string $commission
 * @property string $commissionRate
 * @property string $30daysCommission
 * @property int $volume
 * @property string $packageType
 * @property int $lotNum
 * @property string $validTime
 * @property string $localPrice
 * @property string $storeUrl
 * @property string $storeName
 * @property string $allImageUrls
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot where30daysCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereAllImageUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereEvaluateScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereLocalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereLotNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot wherePackageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereProductTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereProductUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereStoreUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereValidTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductsSnapshot whereVolume($value)
 * @mixin \Eloquent
 */
class ProductsSnapshot extends BaseModel
{
    protected $primaryKey = 'productId';
}
