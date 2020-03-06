<?php


namespace App\Services\Category\Handlers;


use App\Services\Category\Repositories\CmsCategoryRepository;
use Illuminate\Support\Arr;

class StoreHandler
{
    private CmsCategoryRepository $repository;

    /**
     * StoreHandler constructor.
     * @param CmsCategoryRepository $repository
     */
    public function __construct(CmsCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $storeData
     * @return mixed
     */
    public function handle(array $storeData)
    {
        $uploadAttributes = uploader()->upload($storeData['image']);
        $storeData = Arr::add(Arr::except($storeData, ['image']),'image_path', $uploadAttributes['path']);

        return $this->repository->store($storeData);
    }
}
