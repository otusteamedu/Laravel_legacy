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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'distance',
        'user_id',
        'started_at',
        'duration',
        'location_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }
}
