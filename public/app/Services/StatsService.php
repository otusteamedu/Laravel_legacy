<?php


namespace App\Services;

use App\Services\Repositories\StatsRepository;

class StatsService
{
    private $statsRepository;

    public function __construct(StatsRepository $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getRegions()
    {
        return $this->statsRepository->getRegions();
    }

    public function updateRegions()
    {
        $this->statsRepository->updateRegions();
    }
}
