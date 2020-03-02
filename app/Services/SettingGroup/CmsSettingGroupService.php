<?php


namespace App\Services\SettingGroup;


use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\SettingGroup\Repositories\CmsSettingGroupRepository;
use App\Services\Base\Resource\CmsBaseResourceService;
use Illuminate\Support\Collection;

class CmsSettingGroupService extends CmsBaseResourceService
{
    /**
     * SettingGroupServiceCms constructor.
     * @param CmsSettingGroupRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        CmsSettingGroupRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
    }

    /**
     * @return Collection
     */
    public function indexWithSettings(): Collection
    {
        return $this->repository->indexWithSettings();
    }
}
