<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function topics()
    {
        return $this->belongsToMany('App\Models\Category')
            ->wherePivot('category_type', 'topics');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Models\Category')
            ->wherePivot('category_type', 'colors');
    }

    public function interiors()
    {
        return $this->belongsToMany('App\Models\Category')
            ->wherePivot('category_type', 'interiors');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\Owner');
    }

    public function format()
    {
        return $this->belongsTo('App\Models\Format');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
}
