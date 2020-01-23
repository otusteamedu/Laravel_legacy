<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function order(){
        return $this->belongsTo(Order::class, 'delivery_id','id');
    }
}
