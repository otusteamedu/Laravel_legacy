<?php

namespace App\Http\Controllers\Stats;

use Illuminate\Http\Request;
use App\Http\Controllers\Crm\CrmController;
use App\Services\StatsService;

class StatsController extends CrmController
{
    private $statsService;

    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = $this->statsService->getRegions();

        return view('crm.stats.index', ['items' => $items, 'leftNav' => parent::getLeftNav()]);
    }

    public function updateStats()
    {
        $this->statsService->update();
    }
}
