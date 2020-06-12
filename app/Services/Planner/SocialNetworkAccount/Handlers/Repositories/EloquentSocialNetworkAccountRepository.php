<?php


namespace App\Services\Planner\Proxy\Handlers\Repositories;

use App\Models\Planner\PlannerProxy;
use App\Models\Planner\PlannerSocialNetworkAccount;
use Illuminate\Database\Eloquent\Builder;

class EloquentSocialNetworkAccountRepository implements SocialNetworkAccountRepositoryInterface
{
    public function find(int $id)
    {
        return PlannerProxy::find($id);
    }

    public function search(array $filters = [])
    {
        $query = PlannerProxy::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): PlannerSocialNetworkAccount
    {
        $account = new PlannerSocialNetworkAccount();
        $data['user_id'] = \Auth::getUser()->id;
        $account->create($data);
        return $account;
    }

    public function updateFromArray(PlannerSocialNetworkAccount $plannerAccount, array $data):PlannerSocialNetworkAccount
    {
        $plannerAccount->update($data);
        return $plannerAccount;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
