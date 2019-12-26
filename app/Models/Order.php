<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
