<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\WishlistProduct
 *
 * @property int $wishlist_id
 * @property int $product_id
 * @property float $expected_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereExpectedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereWishlistId($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishlistProduct whereId($value)
 */
class WishlistProduct extends BaseModel
{

    protected static $unguarded = true;

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Products::class, 'productId', 'product_id');
    }

    /**
     * @return HasOne
     */
    public function wishlist()
    {
        return $this->hasOne(Wishlist::class, 'id', 'wishlist_id');
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->wishlist()->first()->user_id;
    }

}
