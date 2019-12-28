<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // не нужны поля created_at, updated_at
    public $timestamps = false;

    protected $casts = [
        'available' => 'boolean',
    ];
}
