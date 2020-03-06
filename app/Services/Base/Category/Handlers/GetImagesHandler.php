<?php


namespace App\Services\Base\Category\Handlers;


use App\Services\Base\Category\Repositories\CmsBaseCategoryRepository;
use Illuminate\Support\Arr;

class GetImagesHandler
{
    private CmsBaseCategoryRepository $repository;

    public function __construct(CmsBaseCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $category
     * @param array $pagination
     * @return mixed
     */
    public function handle($category, array $pagination)
    {
        return Arr::has($pagination, 'query')
            ? $this->repository->getQueryImages($category, $pagination)
            : $this->repository->getImages($category, $pagination);
    }
}
