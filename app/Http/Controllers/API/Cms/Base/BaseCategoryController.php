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
    public function getItemsByType(string $type): JsonResponse
    {
        return response()->json($this->service->getItemsByType($type));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function getImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->getImages($id, $request->all()));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function getItemWithImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->getItemWithImages($id, $request->all()));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function getExcludedImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->getExcludedImages($id, $request->all()));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function getItemWithExcludedImages(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->getItemWithExcludedImages($id, $request->all()));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function upload(FormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->upload($request->all(), $id));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function addImages(FormRequest $request, int $id)
    {
        $this->service->addImages($id, $request->all());
    }

    /**
     * @param FormRequest $request
     * @param int $categoryId
     * @param int $imageId
     * @return mixed
     */
    public function removeImage(FormRequest $request, int $categoryId, int $imageId)
    {
        return $this->service->removeImage($categoryId, $imageId, $request->all());
    }
}
