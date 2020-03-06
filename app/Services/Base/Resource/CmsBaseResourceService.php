<?php


namespace App\Services\Base\Resource;


use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

abstract class CmsBaseResourceService
{
    protected CmsBaseResourceRepository $repository;

    protected ClearCacheByTagHandler $clearCacheByTagHandler;

    protected string $cacheTag;

    /**
     * CmsBaseResourceService constructor.
     * @param CmsBaseResourceRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        CmsBaseResourceRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        $this->repository = $repository;
        $this->clearCacheByTagHandler = $clearCacheByTagHandler;
        $this->cacheTag = '';
    }

    /**
     * @return LengthAwarePaginator|Paginator|Collection
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItem(int $id)
    {
        return $this->repository->getItem($id);
    }

    /**
     * @param array $storeData
     * @return mixed
     */
    public function store(array $storeData)
    {
        return $this->repository->store($storeData);
    }

    /**
     * @param array $updateData
     * @param int $id
     * @return mixed
     */
    public function update(int $id, array $updateData)
    {
        $item = $this->repository->getItem($id);

        return $this->repository->update($item, $updateData);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $item = $this->repository->getItem($id);

        return $this->repository->destroy($item);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function publish(int $id)
    {
        $item = $this->repository->getItem($id);

        return $this->repository->publish($item);
    }

    /**
     * Clear cache by tag
     */
    public function clearCacheByTag()
    {
        $this->clearCacheByTagHandler->handle($this->cacheTag);
    }
}
