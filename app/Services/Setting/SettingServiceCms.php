<?php


namespace App\Services\Setting;


use App\Http\Requests\FormRequest;
use App\Models\Setting;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Setting\Handlers\GetSettingsWithTypesHandler;
use App\Services\Setting\Handlers\GetSettingWithTypesHandler;
use App\Services\Setting\Handlers\SetImageSettingValueHandler;
use App\Services\Setting\Repositories\SettingRepositoryCms;
use App\Services\Base\Resource\CmsBaseResourceService;
use Illuminate\Database\Eloquent\Collection;

class SettingServiceCms extends CmsBaseResourceService
{
    private GetSettingWithTypesHandler $showWithTypesHandler;
    private GetSettingsWithTypesHandler $indexWithTypesHandler;
    private SetImageSettingValueHandler $setImageValueHandler;

    /**
     * SettingServiceCms constructor.
     * @param SettingRepositoryCms $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param GetSettingWithTypesHandler $getSettingWithTypesHandler
     * @param GetSettingsWithTypesHandler $getSettingsWithTypesHandler
     * @param SetImageSettingValueHandler $setImageSettingValueHandler
     */
    public function __construct(
        SettingRepositoryCms $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        GetSettingWithTypesHandler $getSettingWithTypesHandler,
        GetSettingsWithTypesHandler $getSettingsWithTypesHandler,
        SetImageSettingValueHandler $setImageSettingValueHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->showWithTypesHandler = $getSettingWithTypesHandler;
        $this->indexWithTypesHandler = $getSettingsWithTypesHandler;
        $this->setImageValueHandler = $setImageSettingValueHandler;
    }

    /**
     * @return array
     */
    public function indexWithTypes(): array
    {
        return $this->indexWithTypesHandler->handle();
    }

    /**
     * @return Collection
     */
    public function indexWithGroup(): Collection
    {
        return $this->repository->indexWithGroup();
    }

    /**
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        return $this->showWithTypesHandler->handle($id);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return Setting
     */
    public function update(FormRequest $request, int $id): Setting
    {
        $item = $this->repository->showModel($id);

        return $this->repository->update($request->all(), $item);
    }

    /**
     * @param FormRequest $request
     */
    public function setTextValue(FormRequest $request)
    {
        $item = $this->repository->showByKey($request->key_name);
        $this->repository->setValue($request->value, $item);
    }

    /**
     * @param FormRequest $request
     */
    public function setImageValue(FormRequest $request)
    {
        $this->setImageValueHandler->handle($request->all());
    }
}
