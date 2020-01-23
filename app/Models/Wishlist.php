<?php

namespace App\Models;

use App\Events\Models\Wishlist\DeletedWishlistEvent;
use App\Events\Models\Wishlist\SavedWishlistEvent;
use App\Listeners\Cache\ClearWishlistsCache;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Models\Wishlist
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WishlistProduct[] $wishlistProducts
 * @property-read int|null $wishlist_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products[] $products
 * @property-read int|null $products_count
 */
class Wishlist extends BaseModel
{

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected $dispatchesEvents = [
        'saved' => SavedWishlistEvent::class,
        'deleted' => DeletedWishlistEvent::class,
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasManyThrough
     */
    public function products()
    {
        return $this->hasManyThrough(Products::class, WishlistProduct::class,
            'wishlist_id',
            'productId',
            'id',
            'product_id'
        );
    }
}
