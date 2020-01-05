<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Texture extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function orders()
    {
        return $this->hasManyThrough('App\Models\Order', 'App\Models\OrderItem');
    }
}
