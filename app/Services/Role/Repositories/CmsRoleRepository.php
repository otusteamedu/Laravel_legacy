<?php


namespace App\Services\Role\Repositories;

use App\Models\Role;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Role\Resources\Role as RoleResource;
use Illuminate\Support\Arr;

class CmsRoleRepository extends CmsBaseResourceRepository
{
    /**
     * TextureRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::withCount('users')->get();
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function getItemWithPermissions(int $id): JsonResource
    {
        return new RoleResource($this->model::findOrFail($id));
    }

    /**
     * @param int $id
     * @return Role
     */
    public function getItem(int $id): Role
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param array $storeData
     * @return mixed
     */
    public function store(array $storeData)
    {
        return $this->model::create(Arr::except($storeData, 'permissions'))
            ->attachPermissions($storeData['permissions']);
    }

    /**
     * @param $item
     * @param array $updateData
     * @return Role
     */
    public function update($item, array $updateData): Role
    {
        $item->update(Arr::except($updateData, 'permissions'));
        $item->syncPermissions($updateData['permissions']);

        return $item;
    }
}
