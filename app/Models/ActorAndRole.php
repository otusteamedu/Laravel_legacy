<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorAndRole extends Model
{
    //

    protected $table = 'actors_and_roles';


    public function films()
    {
      //один ко многим
       return $this->hasMany(Film::class);
    }

    public function actors()
    {
      //один ко многим
       return $this->hasMany(Film::class);
    }
}
