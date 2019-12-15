<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'title',
        'extcode',
        'quantity',
        'mass',
        'retprice',
        'vatrate',
        'barcode',
        'arcticle',
        'volume',
        'length',
        'width',
        'height',
        'type',
    ];
}
