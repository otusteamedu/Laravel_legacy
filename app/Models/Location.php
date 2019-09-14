<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App\Models
 *
 * @property User user
 * @property Workout workouts
 */
class Location extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function workouts()
    {
        return $this->hasMany('App\Models\Workout');
    }
}
