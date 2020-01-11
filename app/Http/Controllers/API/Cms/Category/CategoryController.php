<?php

namespace App\Http\Controllers\Api\Cms\Category;

use App\Http\Controllers\Api\Cms\Category\Requests\CreateCategoryRequest;
use App\Http\Controllers\Api\Cms\Category\Requests\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController
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
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        return response()->json($this->service->index());
    }

    /**
     * @param string $type
     * @return JsonResponse
     */
    public function indexByType(string $type): JsonResponse
    {
        return response()->json($this->service->indexByType($type));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->show($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function showWithImages(int $id): JsonResponse
    {
        return response()->json($this->service->showWithImages($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function showWithExcludedImages(int $id): JsonResponse
    {
        return response()->json($this->service->showWithExcludedImages($id));
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

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        return $this->service->destroy($id);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function publish(int $id): JsonResponse
    {
        return response()->json($this->service->publish($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getImageList(int $id): JsonResponse
    {
        return response()->json($this->service->getImageList($id));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function upload(Request $request, int $id): JsonResponse
    {
        return response()->json($this->service->upload($request, $id));
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function addImages(Request $request, int $id)
    {
        $this->service->addImages($request, $id);
    }

    /**
     * @param int $categoryId
     * @param int $imageId
     * @return int
     */
    public function removeImage(int $categoryId, int $imageId): int
    {
        return $this->service->removeImage($categoryId, $imageId);
    }
}
