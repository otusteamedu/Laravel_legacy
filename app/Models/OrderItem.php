<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }

    public function texture()
    {
        return $this->belongsTo('App\Models\Texture');
    }
}
