<?php


namespace App\Services\Planner\Proxy\Handlers;

use App\Models\Planner\PlannerSocialNetworkAccount;

class DeleteSocialNetworkAccountHandler
{
    /**
     * @param PlannerSocialNetworkAccount $plannerSocialNetworkAccount
     * @param array $data
     */
    public function handle(PlannerSocialNetworkAccount $plannerSocialNetworkAccount)
    {
        try {
            $plannerSocialNetworkAccount->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
