<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order
 *
 * @property int id
 * @property int buyer_id
 * @property int owner_id
 * @property string session_id
 * @property string number
 * @property integer count
 * @property integer total
 * @property string name
 * @property string phone
 * @property string email
 * @property string status
 * @property \Illuminate\Support\Carbon $ordered_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property User owner
 * @property User buyer
 *
 * @package App\Models
 */
class Order extends Model
{
    const STATUS_SESSION = 'cart';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_DONE = 'done';
    const STATUS_CANCELED = 'canceled';

    public $timestamps = true;

    protected $fillable = [
        'buyer_id',
        'owner_id',
        'session_id',
        'ordered_at',
        'number',
        'count',
        'total',
        'name',
        'phone',
        'email',
        'status',
        'created_at',
        'updated_at'
    ];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function buyer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
