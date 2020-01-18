<?php

namespace App\Http\Controllers\Api\Cms\Category;

use App\Http\Controllers\API\Cms\Base\BaseCategoryController;
use App\Http\Controllers\Api\Cms\Category\Requests\CreateCategoryRequest;
use App\Http\Controllers\Api\Cms\Category\Requests\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseCategoryController
{
    /**
     * @var CategoryService
     */
    protected $service;

    /**
     * CategoryController constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($request, $id));
    }
}
