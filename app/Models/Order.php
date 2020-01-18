<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
    public function images() {
        return $this->hasManyThrough('App\Models\Image', 'App\Models\OrderItem');
    }

    public function statuses() {
        return $this->belongsToMany('App\Models\OrderStatus', 'order_order_status', 'order_id', 'status_id');
    }

    public function delivery() {
        return $this->belongsTo('App\Models\Delivery');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address');
    }

    public function textures() {
        return $this->hasManyThrough('App\Models\Texture', 'App\Models\OrderItem');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
