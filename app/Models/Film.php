<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Film extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'films';


    public function actors()
    {
       return $this->hasMany(Actor::class);
    }
}
