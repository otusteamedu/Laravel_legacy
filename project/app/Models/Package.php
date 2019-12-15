<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'strbarcode',
        'mass',
        'message',
        'length',
        'width',
        'height'
    ];
}