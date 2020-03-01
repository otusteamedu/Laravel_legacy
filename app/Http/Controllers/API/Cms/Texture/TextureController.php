<?php

namespace App\Http\Controllers\API\Cms\Texture;

use App\Http\Controllers\API\Cms\Texture\Requests\CreateTextureRequest;
use App\Http\Controllers\API\Cms\Texture\Requests\UpdateTextureRequest;
use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Services\Texture\TextureServiceCms;
use Illuminate\Http\JsonResponse;

class TextureController extends BaseResourceController
{
    /**
     * TextureController constructor.
     * @param TextureServiceCms $service
     */
    public function __construct(TextureServiceCms $service) {
        parent::__construct($service);
    }

    /**
     * @param CreateTextureRequest $request
     * @return JsonResponse
     */
    public function store(CreateTextureRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request));
    }

    /**
     * @param UpdateTextureRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateTextureRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($request, $id));
    }
}
