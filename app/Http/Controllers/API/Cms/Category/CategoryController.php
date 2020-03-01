<?php

namespace App\Http\Controllers\API\Cms\Category;

use App\Http\Controllers\API\Cms\Base\BaseCategoryController;
use App\Http\Controllers\API\Cms\Category\Requests\CreateCategoryRequest;
use App\Http\Controllers\API\Cms\Category\Requests\UpdateCategoryRequest;
use App\Services\Category\CmsCategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseCategoryController
{
    /**
     * @var CmsCategoryService
     */
    protected $service;

    /**
     * CategoryController constructor.
     * @param CmsCategoryService $service
     */
    public function __construct(CmsCategoryService $service)
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
