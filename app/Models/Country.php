<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Models\Country
 *
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
