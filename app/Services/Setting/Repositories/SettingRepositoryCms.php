<?php


namespace App\Services\Setting\Repositories;

use App\Models\Setting;
use App\Services\Base\Resource\Repositories\BaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository extends BaseResourceRepository
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
    public function indexWithGroup(): Collection
    {
        return $this->model::with('group')->get();
    }

    /**
     * @param int $id
     * @return Setting
     */
    public function show(int $id): Setting
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param int $id
     * @return Setting
     */
    public function showModel(int $id): Setting
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param string $key
     * @return Setting
     */
    public function showByKey(string $key): Setting
    {
        return $this->model::where('key_name', $key)->firstOrFail();
    }

    /**
     * @param string|null $value
     * @param Setting $item
     */
    public function setValue($value, Setting $item)
    {
        $item->value = $value;
        $item->save();
    }
}
