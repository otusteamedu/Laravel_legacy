<?php

namespace App\Models;

/**
 * App\Models\Product
 *
 * @property Company company
 * @property ProductUser users
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @mixin \Eloquent
 */
class Product extends Model
{

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')
            ->using('App\Models\ProductUser');
    }

}
