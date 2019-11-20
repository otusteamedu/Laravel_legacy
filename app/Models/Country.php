<?php

namespace App\Models;

use App\Services\Events\Models\Country\CountrySaved;
use Illuminate\Support\Collection;

/**
 * App\Models\CountryResource
 *
 * @property int id
 * @property string name
 * @property string continent_name
 * @property int created_user_id
 * @property City[]|Collection cities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country query()
 * @mixin \Eloquent
 */
class Country extends Model
{

    protected $dispatchesEvents = [
        'saved' => CountrySaved::class,
    ];

    protected $fillable = [
        'name',
        'continent_name',
        'created_user_id',
    ];

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function createdUser()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}
