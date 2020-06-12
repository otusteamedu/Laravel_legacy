<?php


namespace App\Services\Planner\Proxy\Handlers;


use App\Models\Planner\PlannerProxy;
use App\Models\Planner\PlannerSocialNetworkAccount;
use App\Services\Planner\Proxy\Handlers\Repositories\EloquentSocialNetworkAccountRepository;

class UpdateSocialNetworkAccountHandler
{
    /**
     * @var EloquentSocialNetworkAccountRepository
     */
    public $plannerSocialNetworkAccount;

    public function __construct(EloquentSocialNetworkAccountRepository $plannerSocialNetworkAccount)
    {
        $this->plannerSocialNetworkAccount = $plannerSocialNetworkAccount;
    }

    /**
     * @param PlannerSocialNetworkAccount $plannerSocialNetworkAccount
     * @param array $data
     * @return PlannerSocialNetworkAccount
     */
    public function handle(PlannerSocialNetworkAccount $plannerSocialNetworkAccount, array $data): PlannerSocialNetworkAccount
    {
        return $this->plannerSocialNetworkAccount->updateFromArray($plannerSocialNetworkAccount, $data);
    }
}
