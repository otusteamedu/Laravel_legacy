<?php


namespace App\Listeners\Stats\Regions;

use App\Jobs\UpdateStats;
use App\Services\StatsService;

class UpdateRegionsStatsListener
{
    public function handle()
    {
        dispatch(new UpdateStats(new StatsService()));
    }
}
