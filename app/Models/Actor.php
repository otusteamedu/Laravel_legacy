<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'actors';


    public function films()
    {
      //один ко многим
       return $this->hasMany(Contragent::class);
    }

}
