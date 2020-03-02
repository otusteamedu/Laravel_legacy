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
    public function show(int $id): JsonResource
    {
        return new RoleResource($this->model::findOrFail($id));
    }

    /**
     * @param int $id
     * @return Role
     */
    public function showModel(int $id): Role
    {
        return $this->model::findOrFail($id);
    }

    public function store(array $data) {
        return $this->model::create(Arr::except($data, 'permissions'))
            ->attachPermissions($data['permissions']);
    }

    /**
     * @param array $data
     * @param Role $item
     * @return Role
     */
    public function update(array $data, $item): Role {
        $item->update(Arr::except($data, 'permissions'));
        $item->syncPermissions($data['permissions']);

        return $item;
    }
}
