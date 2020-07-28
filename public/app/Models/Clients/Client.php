<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use App\Services\Events\Models\Client\ClientSaved;

/**
 * Class Client
 * @package App\Models\Clients
 */

class Client extends Model
{
    protected $dispatchesEvents = ['saved' => ClientSaved::class];

    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }
}
