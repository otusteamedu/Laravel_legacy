<?php


namespace App\Services\SettingGroup;


use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\SettingGroup\Repositories\SettingGroupRepositoryCms;
use App\Services\Base\Resource\CmsBaseResourceService;
use Illuminate\Support\Collection;

class SettingGroupServiceCms extends CmsBaseResourceService
{
    /**
     * SettingGroupServiceCms constructor.
     * @param SettingGroupRepositoryCms $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        SettingGroupRepositoryCms $repository,
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
