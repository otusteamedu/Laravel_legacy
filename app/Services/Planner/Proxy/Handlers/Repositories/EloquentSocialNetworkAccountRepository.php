<?php


namespace App\Services\Planner\Proxy\Handlers\Repositories;


use App\Models\Planner\PlannerProxy;
use App\Models\User;
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

    public function createFromArray(array $data): PlannerProxy
    {
        $proxy = new PlannerProxy();
        $data['user_id'] = \Auth::getUser()->id;
        $proxy->create($data);
        return $proxy;
    }

    public function updateFromArray(PlannerProxy $plannerProxy, array $data):PlannerProxy
    {
        $plannerProxy->update($data);
        return $plannerProxy;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
