<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function role(){
        return $this->hasOne('App\Models\User');
    }
}
