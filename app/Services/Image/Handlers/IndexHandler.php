<?php


namespace App\Services\Image\Handlers;


use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Support\Arr;

class IndexHandler
{
    public function handle(CmsBaseResourceRepository $repository, array $data)
    {
        return Arr::has($data, 'query')
            ? $repository->paginateQuerySearchIndex($data)
            : $repository->paginateIndex($data);
    }
}
