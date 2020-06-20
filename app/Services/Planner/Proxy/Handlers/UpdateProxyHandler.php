<?php


namespace App\Services\Planner\Proxy\Handlers;


use App\Models\Planner\PlannerProxy;
use App\Services\Planner\Proxy\Handlers\Repositories\EloquentProxyRepository;

class UpdateProxyHandler
{
    /**
     * @var EloquentProxyRepository
     */
    public $proxyRepository;

    public function __construct(EloquentProxyRepository $proxyRepository)
    {
        $this->proxyRepository = $proxyRepository;
    }

    /**
     * @param PlannerProxy $plannerProxy
     * @param array $data
     * @return PlannerProxy
     */
    public function handle(PlannerProxy $plannerProxy, array $data): PlannerProxy
    {
        return $this->proxyRepository->updateFromArray($plannerProxy, $data);
    }
}
