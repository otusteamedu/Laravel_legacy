<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function delivery(){
        return $this->hasOne(Delivery::class, 'id','delivery_id');
    }

    public function order(){
        return $this->belongsToMany(ProductOrder::class, 'order_product', 'order_id', 'id');
    }
}
