<?php

namespace App\Models\Schedule;

use Illuminate\Http\Request;

/**
 * Class TruckSchedule
 *
 * @package App\Models\Schedule
 * @property-read \App\Models\Region $region
 * @property-read \App\Models\Transport\Truck $transport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule\TruckSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule\TruckSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule\TruckSchedule query()
 * @mixin \Eloquent
 */

class TruckSchedule extends Schedule implements ScheduleInterface
{
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

    /**
     * @param Request $request
     * @return bool
     */

    public function newRoute(Request $request)
    {
        return self::store($request, self::class);
    }
}
