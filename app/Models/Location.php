<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Location
 *
 * @property User user
 */
class Location extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
