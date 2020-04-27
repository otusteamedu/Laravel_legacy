<?php

namespace App\Http\Controllers\API\Client\User;


use App\Http\Controllers\API\Client\User\Requests\LikesRequest;
use App\Http\Controllers\API\Client\User\Requests\UpdateEmailRequest;
use App\Http\Controllers\API\Client\User\Requests\UpdateNameRequest;
use App\Http\Controllers\Controller;
use App\Services\User\ClientUserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private ClientUserService $service;

    /**
     * UserController constructor.
     * @param ClientUserService $service
     */
    public function __construct(ClientUserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getItem(int $id): JsonResponse
    {
        return response()->json($this->service->getItem($id));
    }

    /**
     * @param UpdateNameRequest $request
     * @return mixed
     */
    public function updateName(UpdateNameRequest $request)
    {
        return $this->service->updateName($request->all());
    }

    /**
     * @param UpdateEmailRequest $request
     * @return mixed
     */
    public function updateEmail(UpdateEmailRequest $request)
    {
        return $this->service->updateEmail($request->all());
    }

    /**
     * @return JsonResponse
     */
    public function getOrders(): JsonResponse
    {
        return response()->json($this->service->getOrders());
    }

    /**
     * @param int $number
     * @return JsonResponse
     */
    public function getOrder(int $number): JsonResponse
    {
        return response()->json($this->service->getOrder($number));
    }

    /**
     * @param int $number
     * @return JsonResponse
     */
    public function cancelOrder(int $number): JsonResponse
    {
        return response()->json($this->service->cancelOrder($number));
    }

    /**
     * @param LikesRequest $request
     * @return JsonResponse
     */
    public function syncLikes(LikesRequest $request): JsonResponse
    {
        return response()->json($this->service->syncLikes($request->items));
    }

    /**
     * @param int $imageId
     * @return JsonResponse
     */
    public function toggleLike(int $imageId): JsonResponse
    {
        return response()->json($this->service->toggleLike($imageId));
    }
}
