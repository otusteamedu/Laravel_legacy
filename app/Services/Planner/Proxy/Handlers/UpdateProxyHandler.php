<?php


namespace App\Services\Planner\Proxy\Handlers;


use App\Models\Planner\PlannerProxy;
use App\Services\Planner\Proxy\Handlers\Repositories\EloquentSocialNetworkAccountRepository;

class UpdateProxyHandler
{
    /**
     * @var EloquentSocialNetworkAccountRepository
     */
    public $proxyRepository;

    public function __construct(EloquentSocialNetworkAccountRepository $proxyRepository)
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
