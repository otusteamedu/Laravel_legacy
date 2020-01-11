<?php


namespace App\Services\Category\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Support\Arr;

class CreateCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FormRequest $request
     * @return Category
     */
    public function handle(FormRequest $request): Category {
        $uploadAttributes = uploader()->upload($request->image);
        $data = Arr::add($request->except(['image']),'image_path', $uploadAttributes['path']);

        return $this->repository->store($data);
    }
}
