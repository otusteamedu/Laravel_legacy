<?php


namespace App\Services\SettingGroup;


use App\Services\SettingGroup\Repositories\SettingGroupRepository;
use App\Services\Resource\ResourceService;
use Illuminate\Support\Collection;

class SettingGroupService extends ResourceService
{
    /**
     * SettingGroupService constructor.
     * @param SettingGroupRepository $repository
     */
    public function __construct(SettingGroupRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return Collection
     */
    public function indexWithSettings(): Collection
    {
        return $this->repository->indexWithSettings();
    }
}
