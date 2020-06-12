<?php


namespace App\Services\Planner\Proxy\Handlers;

use App\Models\Planner\PlannerSocialNetworkAccount;
use App\Services\Planner\Proxy\Handlers\Repositories\EloquentSocialNetworkAccountRepository;

class CreateSocialNetworkAccountHandler
{
    /**
     * @var EloquentSocialNetworkAccountRepository
     */
    private $plannerSocialNetworkAccount;

    public function __construct(
        EloquentSocialNetworkAccountRepository $plannerSocialNetworkAccount
    )
    {
        $this->plannerSocialNetworkAccount = $plannerSocialNetworkAccount;
    }

    /**
     * @param array $data
     * @return PlannerSocialNetworkAccount
     */
    public function handle(array $data): PlannerSocialNetworkAccount
    {
        return $this->plannerSocialNetworkAccount->createFromArray($data);
    }
}
