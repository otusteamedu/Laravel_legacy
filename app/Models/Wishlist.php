<?php

namespace App\Models;

/**
 * App\Models\Wishlist
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wishlist whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WishlistProduct[] $products
 * @property-read int|null $products_count
 */
class Wishlist extends BaseModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(WishlistProduct::class);
    }
}
