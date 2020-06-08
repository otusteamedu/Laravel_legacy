<?php


namespace App\Services\Planner\Proxy\Handlers;


use App\Models\Planner\PlannerProxy;

class DeleteProxyHandler
{
    /**
     * @param PlannerProxy $blogAuthor
     * @param array $data
     */
    public function handle(PlannerProxy $plannerProxy)
    {
        try {
            $plannerProxy->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
