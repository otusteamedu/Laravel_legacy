<?php


namespace App\Services\Planner\Proxy\Handlers;


use App\Models\Planner\PlannerProxy;
use App\Services\Planner\Proxy\Handlers\Repositories\EloquentProxyRepository;

class CreateProxyHandler
{
    /**
     * @var EloquentProxyRepository
     */
    private $proxyRepository;

    public function __construct(
        EloquentProxyRepository $proxyRepository
    )
    {
        $this->proxyRepository = $proxyRepository;
    }

    /**
     * @param array $data
     * @return PlannerProxy
     */
    public function handle(array $data): PlannerProxy
    {
        return $this->proxyRepository->createFromArray($data);
    }
}
