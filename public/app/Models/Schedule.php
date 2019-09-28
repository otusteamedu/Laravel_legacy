<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 * @package App\Models
 */

class Schedule extends Model
{
    protected $table = 'schedule';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function transport()
    {
        return $this->hasOne('App\Models\Transport\Truck', 'id', 'transport_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }
}
