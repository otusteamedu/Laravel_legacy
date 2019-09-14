<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Workout
 * @package App\Models
 *
 * @property User user
 * @property Location location
 */
class Workout extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }
}
