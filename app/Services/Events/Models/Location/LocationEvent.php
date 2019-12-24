<?php

namespace App\Services\Events\Models\Location;

use App\Models\Location;

abstract class LocationEvent
{
    /**
     * @var Location
     */
    private $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function getLocation() {
        return $this->location;
    }
}
