<?php

namespace App\Http\Controllers\API\Cms\Owner;

use App\Http\Controllers\API\Cms\SubCategory\SubCategoryController;
use App\Services\Owner\OwnerService;
use App\Http\Controllers\Api\Cms\Owner\Requests\CreateOwnerRequest;
use App\Http\Controllers\Api\Cms\Owner\Requests\UpdateOwnerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class OwnerController extends SubCategoryController
{
    public function __construct(OwnerService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateOwnerRequest $request
     * @return JsonResponse
     */
    public function store(CreateOwnerRequest $request): JsonResponse {
        return Response::Json($this->service->store($request));
    }

    /**
     * @param UpdateOwnerRequest $request
     * @param int $id
     */
    public function update(UpdateOwnerRequest $request, int $id) {
        $this->service->update($request, $id);
    }
}
