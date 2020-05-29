<?php

namespace App\Models;

/**
 * App\Models\OrderStatusTranslation
 *
 * @property int $id
 * @property int $order_status_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation whereOrderStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatusTranslation whereLocale($value)
 */
class OrderStatusTranslation extends Model
{
    protected $fillable = [
        'order_status_id',
        'locale',
        'attribute',
        'value'
    ];
}
