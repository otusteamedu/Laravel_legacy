<?php

namespace App\Models;

/**
 * App\Models\City
 *
 * @proprety int id
 * @proprety int country_id
 * @proprety string name
 * @proprety CountryResource country
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
        return $this->belongsTo(Country::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Company::class);
    }



}
