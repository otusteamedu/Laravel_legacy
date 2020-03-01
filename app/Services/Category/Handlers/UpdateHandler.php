<?php


namespace App\Services\Category\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\Category;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Support\Arr;

class UpdateHandler
{
    /**
     * @param FormRequest $request
     * @param CmsBaseResourceRepository $repository
     * @param Category $category
     * @return mixed
     */
    public function handle(FormRequest $request, CmsBaseResourceRepository $repository, Category $category)
    {
        if($request->image) {
            $uploadArray = uploader()->refresh($category->image_path, $request->image);
            $data = Arr::add($request->except('image'), 'image_path', $uploadArray['path']);
        } else {
            $data = $request->all();
        }

        return $repository->update($data, $category);
    }
}
