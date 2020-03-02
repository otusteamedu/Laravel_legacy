<?php


namespace App\Services\Category\Handlers;


use App\Http\Requests\FormRequest;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Support\Arr;

class StoreHandler
{
    /**
     * @param FormRequest $request
     * @param CmsBaseResourceRepository $repository
     * @return mixed
     */
    public function handle(FormRequest $request, CmsBaseResourceRepository $repository)
    {
        $uploadAttributes = uploader()->upload($request->image);
        $data = Arr::add($request->except(['image']),'image_path', $uploadAttributes['path']);

        return $repository->store($data);
    }
}
