<?php


namespace App\Services\Setting;


use App\Models\Setting;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Setting\Handlers\SetImageSettingValueHandler;
use App\Services\Setting\Repositories\CmsSettingRepository;
use App\Services\Base\Resource\CmsBaseResourceService;
use Illuminate\Database\Eloquent\Collection;

class CmsSettingService extends CmsBaseResourceService
{
    private SetImageSettingValueHandler $setImageValueHandler;
    private array $types;

    /**
     * SettingServiceCms constructor.
     * @param CmsSettingRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param SetImageSettingValueHandler $setImageSettingValueHandler
     */
    public function __construct(
        CmsSettingRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        SetImageSettingValueHandler $setImageSettingValueHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->setImageValueHandler = $setImageSettingValueHandler;
        $this->types = Setting::TYPES;
    }

    /**
     * @param array $storeData
     * @return mixed
     */
    public function store(array $storeData)
    {
        if ($storeData['group_id'] == 0) {
            $storeData['group_id'] = null;
        }

        return $this->repository->store($storeData);
    }

    /**
     * @return array
     */
    public function getItemsWithTypes(): array
    {
        $items = $this->repository->index();

        return [ 'items' => $items, 'types' => $this->types ];
    }

    /**
     * @return Collection
     */
    public function getItemsWithGroup(): Collection
    {
        return $this->repository->getItemsWithGroup();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getItemWithTypes(int $id): array
    {
        $item = $this->repository->getItem($id);

        return [ 'item' => $item, 'types' => $this->types ];
    }

    /**
     * @param int $id
     * @param array $updateData
     * @return Setting
     */
    public function update(int $id, array $updateData): Setting
    {
        $item = $this->repository->getItem($id);

        return $this->repository->update($item, $updateData);
    }

    /**
     * @param array $setData
     */
    public function setTextValue(array $setData)
    {
        $item = $this->repository->getItemByKey($setData['key_name']);
        $this->repository->setValue($item, $setData['value']);
    }

    /**
     * @param array $setData
     */
    public function setImageValue(array $setData)
    {
        $this->setImageValueHandler->handle($setData);
    }
}
