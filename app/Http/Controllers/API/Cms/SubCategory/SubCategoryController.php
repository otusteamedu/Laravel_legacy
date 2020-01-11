<?php

namespace App\Http\Controllers\API\Cms\SubCategory;

use App\Services\SubCategory\SubCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class SubCategoryController
{
    /**
     * @var SubCategoryService
     */
    protected $service;

    /**
     * CategoryController constructor.
     * @param SubCategoryService $service
     */
    public function __construct(SubCategoryService $service)
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

//    public function store(){}
//
//    public function update(){}

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int {
        return $this->service->destroy($id);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function publish(int $id): JsonResponse {
        return response()->json($this->service->publish($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getImageList(int $id): JsonResponse {
        return response()->json($this->service->getImageList($id));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function upload(Request $request, int $id): JsonResponse {
        return response()->json($this->service->upload($request, $id));
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function addImages(Request $request, int $id) {
        $this->service->addImages($request, $id);
    }

    /**
     * @param int $categoryId
     * @param int $imageId
     * @return int
     */
    public function removeImage(int $categoryId, int $imageId): int {
        return $this->service->removeImage($categoryId, $imageId);
    }
}
