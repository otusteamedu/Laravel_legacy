<?php

namespace App\Http\Controllers\API\Cms\Image;

use App\Http\Controllers\Api\Cms\Image\Requests\UpdateImageRequest;
use App\Services\Image\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImageController
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
    public function show(int $id): JsonResponse {
        return response()->json($this->service->show($id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        return response()->json($this->service->store($request));
    }

    /**
     * @param UpdateImageRequest $request
     * @param int $id
     */
    public function update(UpdateImageRequest $request, int $id) {
        $this->service->update($request, $id);
    }

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
}
