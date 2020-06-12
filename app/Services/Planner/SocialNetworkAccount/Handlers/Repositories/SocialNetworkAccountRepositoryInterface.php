<?php
namespace App\Services\Planner\Proxy\Handlers\Repositories;

use App\Models\Planner\PlannerSocialNetworkAccount;

interface SocialNetworkAccountRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): PlannerSocialNetworkAccount;

    public function updateFromArray(PlannerSocialNetworkAccount $proxy, array $data):PlannerSocialNetworkAccount;

}
