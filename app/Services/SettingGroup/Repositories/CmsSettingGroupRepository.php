<?php


namespace App\Services\SettingGroup\Repositories;

use App\Models\SettingGroup;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class CmsSettingGroupRepository extends CmsBaseResourceRepository
{
    /**
     * SettingGroupRepository constructor.
     * @param SettingGroup $model
     */
    public function __construct(SettingGroup $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::withCount('settings')->get();
    }

    /**
     * @return Collection
     */
    public function getItemsWithSettings(): Collection
    {
        return $this->model::has('settings')
            ->with('settings')
            ->get();
    }
}
