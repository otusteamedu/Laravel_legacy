<?php

namespace App\Http\Controllers\API\Cms\Resource;

use App\Http\Requests\FormRequest;
use App\Services\Resource\ResourceService;
use Illuminate\Http\JsonResponse;

class ResourceController
{
    /**
     * @var ResourceService
     */
    protected $service;

    /**
     * CrudMethods constructor.
     * @param ResourceService $service
     */
    public function __construct(ResourceService $service)
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

//    /**
//     * @param FormRequest $request
//     * @return JsonResponse
//     */
//    public function store(FormRequest $request): JsonResponse
//    {
//        return response()->json($this->service->store($request));
//    }
//
//    /**
//     * @param FormRequest $request
//     * @param int $id
//     * @return JsonResponse
//     */
//    public function update(FormRequest $request, int $id): JsonResponse
//    {
//        return response()->json($this->service->update($request, $id));
//    }

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
