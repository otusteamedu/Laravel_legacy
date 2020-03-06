<?php


namespace App\Services\Image\Handlers;


use App\Services\Image\Repositories\CmsImageRepository;
use Illuminate\Support\Arr;

class GetItemsHandler
{
    private CmsImageRepository $repository;

    /**
     * IndexHandler constructor.
     * @param CmsImageRepository $repository
     */
    public function __construct(CmsImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $pagination
     * @return \Illuminate\Contracts\Pagination\Paginator|mixed
     */
    public function handle(array $pagination)
    {
        return Arr::has($pagination, 'query')
            ? $this->repository->getQueryItems($pagination)
            : $this->repository->getItems($pagination);
    }
}
