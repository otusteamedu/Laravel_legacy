<?php

namespace App\Http\Controllers\API\Cms\Image;

use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\Api\Cms\Image\Requests\UpdateImageRequest;
use App\Http\Requests\FormRequest;
use App\Services\Image\ImageService;
use Illuminate\Http\JsonResponse;

class ImageController extends BaseResourceController
{
    /**
     * @var ImageService
     */
    protected $service;

    /**
     * ImageController constructor.
     * @param ImageService $service
     */
    public function __construct(ImageService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function store(FormRequest $request): JsonResponse {
        return response()->json($this->service->store($request));
    }

    /**
     * @param UpdateImageRequest $request
     * @param int $id
     */
    public function update(UpdateImageRequest $request, int $id) {
        $this->service->update($request, $id);
    }
}
