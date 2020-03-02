<?php


namespace App\Services\Base\Resource;


use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use App\Services\Cache\KeyManager as CacheKeyManager;
use Illuminate\Database\Eloquent\Collection;

abstract class ClientBaseResourceService
{
    protected ClientBaseResourceRepository $repository;

    protected CacheKeyManager $cacheKeyManager;

    /**
     * ClientBaseResourceService constructor.
     * @param ClientBaseResourceRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     */
    public function __construct(
        ClientBaseResourceRepository $repository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->repository = $repository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->repository->show($id);
    }
}
