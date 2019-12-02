<?php

namespace App\Models\Route;

use App\Models\Region;
use App\Models\Transport\Transport;
use App\Models\Validator\BusValidator;

/**
 * Class SimpleRoute
 * @package App\Models\Route
 */

class SimpleRoute implements RouteInterface
{
    /**
     * SimpleRoute constructor.
     * @param Region $region
     * @param Transport $transport
     * @param $date
     */

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
        if ($this->transport->isAvailable(new BusValidator(), $this->date)) {
            return [$this->date, $interval, $this->region->id];
        }
    }
}
