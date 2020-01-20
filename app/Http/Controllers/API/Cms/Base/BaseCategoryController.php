<?php

namespace App\Http\Controllers\API\Cms\Base;

use App\Http\Requests\FormRequest;
use App\Services\Base\Category\BaseCategoryService;
use Illuminate\Http\JsonResponse;

class BaseCategoryController extends BaseResourceController
{
    /**
     * BaseCategoryController constructor.
     * @param BaseCategoryService $service
     */
    public function __construct(BaseCategoryService $service)
    {
        parent::__construct($service);
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
     * @param int $id
     * @return JsonResponse
     */
    public function getImageList(int $id): JsonResponse
    {
        return response()->json($this->service->getImageList($id));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function upload(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->upload($request, $id));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function addImages(FormRequest $request, int $id)
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
