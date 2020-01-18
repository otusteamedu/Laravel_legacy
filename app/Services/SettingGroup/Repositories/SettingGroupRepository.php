<?php


namespace App\Services\SettingGroup\Repositories;

use App\Models\SettingGroup;
use App\Services\Base\Resource\Repositories\BaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class SettingGroupRepository extends BaseResourceRepository
{
    /**
     * SettingGroupRepository constructor.
     * @param SettingGroup $model
     */
    public function __construct(SettingGroup $model)
    {
        $this->model = $model;
    }

    public function index(): Collection
    {
        return $this->model::withCount('settings')
            ->get();
    }

    public function indexWithSettings(): Collection
    {
        return $this->model::has('settings')
            ->with('settings')
            ->get();
    }
}