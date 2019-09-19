<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country
 *
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
    ];

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
    
}