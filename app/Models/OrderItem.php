<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OrderItem
 *
 * @property int id
 * @property int order_id
 * @property int product_id
 * @property string product_class
 * @property integer price
 * @property string name
 * @property array description
 * @property boolean available
 * @property Order order
 *
 * @package App\Models
 */
class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_class',
        'price',
        'name',
        'description',
        'available'
    ];

    protected $casts = [
        'description' => 'array',
    ];

    public function order() : BelongsTo {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
