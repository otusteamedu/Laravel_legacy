<?php

namespace App\Http\Controllers\API\Cms\Texture;

use App\Http\Controllers\Api\Cms\Texture\Requests\CreateTextureRequest;
use App\Http\Controllers\Api\Cms\Texture\Requests\UpdateTextureRequest;
use App\Http\Controllers\API\Cms\Resource\ResourceController;
use App\Services\Texture\TextureService;
use Illuminate\Http\JsonResponse;

class TextureController extends ResourceController
{
    /**
     * TextureController constructor.
     * @param TextureService $service
     */
    public function __construct(TextureService $service) {
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
