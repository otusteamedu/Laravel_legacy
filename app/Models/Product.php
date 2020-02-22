<?php

namespace App\Models;

use App\Events\Models\Products\CreatProductsEvent;

/**
 * App\Models\Product
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductsSnapshot[] $snapshots
 * @property-read int|null $snapshots_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAllImageUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereEvaluateScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereLocalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereLotNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePackageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStoreUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereValidTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereVolume($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 */
class Product extends BaseModel
{

    protected static $unguarded = true;

    protected $dispatchesEvents = [
        'created' => CreatProductsEvent::class,
    ];
}
