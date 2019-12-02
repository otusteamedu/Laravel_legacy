<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models\Orders
 */

class Order extends Model
{
    public function region()
    {
        return $this->hasOne('App\Models\Region');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Clients\Client');
    }
}
