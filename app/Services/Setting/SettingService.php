<?php


namespace App\Services\Setting;


use App\Http\Requests\FormRequest;
use App\Models\Setting;
use App\Services\Setting\Handlers\GetSettingsWithTypesHandler;
use App\Services\Setting\Handlers\GetSettingWithTypesHandler;
use App\Services\Setting\Handlers\SetImageSettingValueHandler;
use App\Services\Setting\Handlers\SetTextSettingValueHandler;
use App\Services\Setting\Repositories\SettingRepository;
use App\Services\Resource\ResourceService;
use Illuminate\Database\Eloquent\Collection;

class SettingService extends ResourceService
{
    private $showWithTypesHandler;
    private $indexWithTypesHandler;
    private $setTextValueHandler;
    private $setImageValueHandler;

    /**
     * SettingService constructor.
     * @param SettingRepository $repository
     * @param GetSettingWithTypesHandler $getSettingWithTypesHandler
     * @param GetSettingsWithTypesHandler $getSettingsWithTypesHandler
     * @param SetTextSettingValueHandler $setTextSettingValueHandler
     * @param SetImageSettingValueHandler $setImageSettingValueHandler
     */
    public function __construct(
        SettingRepository $repository,
        GetSettingWithTypesHandler $getSettingWithTypesHandler,
        GetSettingsWithTypesHandler $getSettingsWithTypesHandler,
        SetTextSettingValueHandler $setTextSettingValueHandler,
        SetImageSettingValueHandler $setImageSettingValueHandler
    )
    {
        parent::__construct($repository);
        $this->showWithTypesHandler = $getSettingWithTypesHandler;
        $this->indexWithTypesHandler = $getSettingsWithTypesHandler;
        $this->setTextValueHandler = $setTextSettingValueHandler;
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
        $this->setTextValueHandler->handle($request->all());
    }

    /**
     * @param FormRequest $request
     */
    public function setImageValue(FormRequest $request)
    {
        $this->setImageValueHandler->handle($request->all());
    }
}
