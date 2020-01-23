<?php

namespace App\Models;

use App\Events\Models\Products\CreatProductsEvent;

/**
 * App\Models\Products
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereAllImageUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereEvaluateScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereLocalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereLotNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products wherePackageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereProductTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereProductUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereStoreUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereValidTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereVolume($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereId($value)
 */
class Products extends BaseModel
{

    protected static $unguarded = true;

    protected $dispatchesEvents = [
        'created' => CreatProductsEvent::class,
    ];
}
