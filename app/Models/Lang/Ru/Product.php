<?php

namespace App\Models\Lang\Ru;

use App\Models\Model;

/**
 * App\Models\Lang\Ru\OrderStatus
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lang\Ru\OrderStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $table = 'products_ru';

    protected $fillable = [
        'product_id', 'name', 'description'
    ];
}
