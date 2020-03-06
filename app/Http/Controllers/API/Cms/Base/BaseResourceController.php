<?php

namespace App\Http\Controllers\API\Cms\Base;

use App\Services\Base\Resource\CmsBaseResourceService;
use Illuminate\Http\JsonResponse;

class BaseResourceController
{
    /**
     * @var CmsBaseResourceService
     */
    protected $service;

    /**
     * CrudMethods constructor.
     * @param CmsBaseResourceService $service
     */
    public function __construct(CmsBaseResourceService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->service->index());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getItem($id));
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
