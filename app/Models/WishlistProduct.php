<?php

namespace App\Models;

/**
 * App\Models\WishlistProduct
 *
 * @property int $wishlist_id
 * @property int $product_id
 * @property float $expected_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereExpectedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereWishlistId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductsSnapshot[] $productSnapshots
 * @property-read int|null $product_snapshots_count
 */
class WishlistProduct extends BaseModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSnapshots()
    {
        return $this->hasMany(ProductsSnapshot::class, 'productId', 'product_id');
    }
}
