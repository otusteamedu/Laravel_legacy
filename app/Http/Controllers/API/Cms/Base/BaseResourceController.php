<?php

namespace App\Http\Controllers\API\Cms\Base;

use App\Services\Base\Resource\BaseResourceService;
use Illuminate\Http\JsonResponse;

class BaseResourceController
{
    /**
     * @var BaseResourceService
     */
    protected $service;

    /**
     * CrudMethods constructor.
     * @param BaseResourceService $service
     */
    public function __construct(BaseResourceService $service)
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
