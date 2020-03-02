<?php

namespace App\Http\Controllers\API\Cms\Base;

use App\Http\Requests\FormRequest;
use App\Services\Base\Category\CmsBaseCategoryService;
use Illuminate\Http\JsonResponse;

class BaseCategoryController extends BaseResourceController
{
    /**
     * BaseCategoryController constructor.
     * @param CmsBaseCategoryService $service
     */
    public function __construct(CmsBaseCategoryService $service)
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
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function showImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->showImages($request->all(), $id));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function showWithImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->showWithImages($request->all(), $id));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function showExcludedImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->showExcludedImages($request->all(), $id));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function showWithExcludedImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->showWithExcludedImages($request->all(), $id));
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
     * @param FormRequest $request
     * @param int $categoryId
     * @param int $imageId
     * @return mixed
     */
    public function removeImage(FormRequest $request, int $categoryId, int $imageId)
    {
        return $this->service->removeImage($request->all(), $categoryId, $imageId);
    }
}
