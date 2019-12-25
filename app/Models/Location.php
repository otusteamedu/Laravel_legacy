<?php

namespace App\Models;

use App\Services\Events\Models\Location\LocationDeleted;
use App\Services\Events\Models\Location\LocationSaved;
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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'distance',
        'user_id',
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => LocationSaved::class,
        'deleted' => LocationDeleted::class,
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function workouts()
    {
        return $this->hasMany('App\Models\Workout');
    }
}
