<?php

namespace App\Models\Route;

use App\Models\Region;
use App\Models\Transport\Transport;

/**
 * Interface RouteInterface
 * @package App\Models\Route
 */

interface RouteInterface
{
    public function __construct(Region $region, Transport $transport, $date);

    public function create($interval);
}
