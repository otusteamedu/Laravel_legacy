<?php


namespace App\Services\Setting\Repositories;

use App\Models\Setting;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class CmsSettingRepository extends CmsBaseResourceRepository
{
    /**
     * SettingRepository constructor.
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::all();
    }

    /**
     * @return Collection
     */
    public function getItemsWithGroup(): Collection
    {
        return $this->model::with('group')->get();
    }

    /**
     * @param int $id
     * @return Setting
     */
    public function getItem(int $id): Setting
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param string $key
     * @return Setting
     */
    public function getItemByKey(string $key): Setting
    {
        return $this->model::where('key_name', $key)->firstOrFail();
    }

    /**
     * @param Setting $item
     * @param string|null $value
     */
    public function setValue(Setting $item, $value)
    {
        $item->value = $value;
        $item->save();
    }
}
