<?php


namespace App\Http\Controllers\API\Client\Base;


use App\Http\Controllers\Controller;
use App\Services\Base\Resource\ClientBaseResourceService;
use Illuminate\Http\JsonResponse;

abstract class ClientBaseResourceController extends Controller
{
    protected ClientBaseResourceService $service;

    public function __construct(ClientBaseResourceService $service) {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->index());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->show($id));
    }
}
