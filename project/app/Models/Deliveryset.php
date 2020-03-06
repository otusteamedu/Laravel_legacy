<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Deliveryset extends Model
{
    protected $table = 'deliverysets';
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'above_price',
        'return_price',
        'below_sum',
        'price',
    ];
}