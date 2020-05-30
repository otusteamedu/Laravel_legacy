<?php

namespace App\Models\Translations;

/**
 * App\Models\Translations\OrderStatusTranslation
 *
 * @property int $id
 * @property int $order_status_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation whereOrderStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\OrderStatusTranslation whereLocale($value)
 */
class OrderStatusTranslation extends Translation
{
    protected $fillable = [
        'order_status_id',
        'locale',
        'attribute',
        'value'
    ];
}
