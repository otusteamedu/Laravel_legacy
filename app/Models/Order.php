<?php

namespace App\Models;

use App\Events\Models\Order\OrderDeleted;
use App\Events\Models\Order\OrderSaved;
use App\Events\Models\Order\OrderUpdated;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'saved' => OrderSaved::class,
        'updated' => OrderUpdated::class,
        'deleted' => OrderDeleted::class,
    ];

    const DEFAULT_STATUS_ID = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function images() {
        return $this->hasManyThrough('App\Models\Image', 'App\Models\OrderItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function statuses() {
        return $this->belongsToMany('App\Models\OrderStatus', 'order_order_status', 'order_id', 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery() {
        return $this->belongsTo('App\Models\Delivery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address() {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function textures() {
        return $this->hasManyThrough('App\Models\Texture', 'App\Models\OrderItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
