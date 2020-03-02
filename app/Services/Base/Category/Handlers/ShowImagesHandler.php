<?php


namespace App\Services\Base\Category\Handlers;


use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Support\Arr;

class ShowImagesHandler
{
    /**
     * @param CmsBaseResourceRepository $repository
     * @param $category
     * @param array $data
     * @return mixed
     */
    public function handle(CmsBaseResourceRepository $repository, $category, array $data)
    {
        return Arr::has($data, 'query')
            ? $repository->showQuerySearchImages($category, $data)
            : $repository->showImages($category, $data);
    }
}
