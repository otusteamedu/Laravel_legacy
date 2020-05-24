<?php

namespace App\Models;

use App\Models\Lang\Ru\OrderStatus as OrderStatusRu;

/**
 * App\Models\OrderStatus
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereUpdatedAt($value)
 * @method \App\Models\OrderStatus nameRu($name)
 * @mixin \Eloquent
 */
class OrderStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'position'
    ];

    public function nameRu($name)
    {
        $orderStatusRu = OrderStatusRu::where('order_status_id', $this->id)->first();

        if (!$orderStatusRu) {
            $orderStatusRu = new OrderStatusRu();
            $orderStatusRu->order_status_id = $this->id;
        }

        $orderStatusRu->name = $name;

        $orderStatusRu->save();

        return $orderStatusRu;
    }
}
