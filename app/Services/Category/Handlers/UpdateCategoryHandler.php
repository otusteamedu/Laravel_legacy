<?php


namespace App\Services\Category\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Support\Arr;

class UpdateCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * UpdateCategoryHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(FormRequest $request, Category $category): Category {
        if($request->image) {
            $uploadArray = uploader()->refresh($category->image_path, $request->image);
            $data = Arr::add($request->except('image'), 'image_path', $uploadArray['path']);
        } else {
            $data = $request->all();
        }

        $this->repository->update($data, $category);

        return $category;
    }
}
