<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ProductUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property float $price
 * @property int $count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductUser whereUserId($value)
 */
class ProductUser extends Pivot
{

}
