<?php

namespace App\Models\Route;

use App\Models\DateHelper;
use App\Models\Region;
use App\Models\Transport\Transport;
use App\Models\Validator\BusValidator;

/**
 * Class NightRoute
 * @package App\Models\Route
 */

class NightRoute implements RouteInterface
{
    public function __construct(Region $region, Transport $transport, $date)
    {
        $this->region = $region;
        $this->transport = $transport;
        $this->date = $date;
    }

    /**
     * @param $interval
     * @return array
     */

    public function create($interval)
    {
        $todayDistance = 24 - DateHelper::getHours($this->date);
        $tomorrowDistance = $interval - $todayDistance;
        $tomorrowDatetime = DateHelper::shiftTime($todayDistance, $this->date);

        if ($this->transport->isAvailable(new BusValidator(), $tomorrowDatetime)) {
            return [$tomorrowDatetime, $tomorrowDistance, $this->region->id];
        }
    }
}
