<?php

namespace App\Models\Schedule;

use Illuminate\Http\Request;

/**
 * Class BusSchedule
 *
 * @package App\Models\Schedule
 * @property-read \App\Models\Region $region
 * @property-read \App\Models\Transport\Bus $transport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule\BusSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule\BusSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule\BusSchedule query()
 * @mixin \Eloquent
 */

class BusSchedule extends Schedule implements ScheduleInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function transport()
    {
        return $this->hasOne('App\Models\Transport\Bus', 'id', 'transport_id');
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
        return $this->store($request, self::class);
    }
}
