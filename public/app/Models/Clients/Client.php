<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App\Models\Clients
 */

class Client extends Model
{
    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }
}
