<?php


namespace App\Services\Role;


use App\Http\Requests\FormRequest;
use App\Models\Role;
use App\Services\Role\Repositories\RoleRepository;
use App\Services\Resource\ResourceService;

class RoleService extends ResourceService
{
    /**
     * RoleService constructor.
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return Role
     */
    public function update(FormRequest $request, int $id): Role
    {
        $item = $this->repository->showModel($id);

        return $this->repository->update($request->all(), $item);
    }
}
