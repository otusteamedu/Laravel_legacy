<?php


namespace App\Services\Category\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\Category;
use App\Services\Base\Category\Repositories\BaseCategoryRepository;
use Illuminate\Support\Arr;

class UpdateHandler
{
    /**
     * @param FormRequest $request
     * @param BaseCategoryRepository $repository
     * @param Category $category
     * @return mixed
     */
    public function handle(FormRequest $request, BaseCategoryRepository $repository, Category $category)
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
