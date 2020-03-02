<?php

namespace App\Http\Controllers\API\Cms\Image;

use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\API\Cms\Image\Requests\UpdateImageRequest;
use App\Http\Requests\FormRequest;
use App\Services\Image\CmsImageService;
use Illuminate\Http\JsonResponse;

class ImageController extends BaseResourceController
{
    /**
     * @var CmsImageService
     */
    protected $service;

    /**
     * ImageController constructor.
     * @param CmsImageService $service
     */
    public function __construct(CmsImageService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function paginateIndex(FormRequest $request): JsonResponse
    {
        return response()->json($this->service->paginateIndex($request->all()));
    }

//    /**
//     * @param FormRequest $request
//     * @return JsonResponse
//     */
//    public function paginateQuerySearchIndex(FormRequest $request): JsonResponse
//    {
//        return response()->json($this->service->paginateQuerySearchIndex($request->all()));
//    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function store(FormRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request));
    }

    /**
     * @param UpdateImageRequest $request
     * @param int $id
     */
    public function update(UpdateImageRequest $request, int $id)
    {
        $this->service->update($request, $id);
    }
}
