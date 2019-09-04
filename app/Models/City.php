<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @proprety Country country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City query()
 * @mixin \Eloquent
 */
class City extends Model
{

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }



}
