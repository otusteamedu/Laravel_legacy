<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Class Payment
 *
 * @property string payment_id
 * @property int order_id
 * @property string stage
 * @property string message
 * @property bool is_error
 * @property array payment_data
 * @property int total
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property Order order
 *
 * @package App\Models
 */
class Payment extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_INPUT = 'input';
    const STATUS_CHECK = 'check';
    const STATUS_DONE = 'done';

    public $timestamps = true;

    protected $casts = [
        'payment_data' => 'array',
    ];

    protected $fillable = [
        'order_id',
        'total',
        'message',
        'is_error',
        'stage',
        'payment_data',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
    public function getIncrementing() {
        return false;
    }
    public function getKeyName() {
        return 'payment_id';
    }
    public function getKeyType() {
        return 'string';
    }
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
