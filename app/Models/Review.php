<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'active'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
