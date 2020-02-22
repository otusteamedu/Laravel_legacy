<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel query()
 * @mixin \Eloquent
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product where30daysCommission($value)
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
 */
	class Products extends \Eloquent {}
}

namespace App\Models{
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
	class ProductsSnapshot extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $status
 * @property int $group
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wishlist[] $wishlists
 * @property-read int|null $wishlists_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WishlistProduct[] $wishlistProducts
 * @property-read int|null $wishlist_products_count
 */
	class Wishlist extends \Eloquent {}
}

namespace App\Models{
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
	class WishlistProduct extends \Eloquent {}
}

