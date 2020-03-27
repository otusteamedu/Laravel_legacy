<?php

namespace App\Models\Schedule;

use Illuminate\Http\Request;

/**
 * Interface ScheduleInterface
 * @package App\Models\Schedule
 */

interface ScheduleInterface
{
    public function transport();

    public function region();

    public function newRoute(Request $request);
}
