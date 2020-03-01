<?php


namespace App\Services\Role;


use App\Http\Requests\FormRequest;
use App\Models\Role;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Role\Repositories\RoleRepositoryCms;
use App\Services\Base\Resource\CmsBaseResourceService;

class RoleServiceCms extends CmsBaseResourceService
{
    /**
     * RoleServiceCms constructor.
     * @param RoleRepositoryCms $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        RoleRepositoryCms $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
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
