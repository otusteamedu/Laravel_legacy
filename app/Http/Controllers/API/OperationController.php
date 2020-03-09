<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use Illuminate\Http\Request;
use App\Http\Resources\OperationResource;
use App\Http\Resources\OperationCollection;
use App\Services\OperationsService;
use App\Helpers\JsonResponseHelper;

class OperationController extends Controller
{
    protected $operationsService;

    public function __construct
    (
        OperationsService $operationsService
    )
    {
        $this->operationsService = $operationsService;
    }

    /**
     * Get user operations
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return JsonResponseHelper::getResponseWithHeaders(new OperationCollection($this->operationsService->getOperationsByUserId(auth()->user()->id)), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 'sum' => 'required|numeric|min:1,max:100000', 'category_id' => 'required|integer', 'description' => 'string|max:1000|nullable']);

         $operation = $this->operationsService->storeOperation([
            'sum' => $request->sum,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        return JsonResponseHelper::getResponseWithHeaders($operation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Operation $operation
     * @return OperationResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Operation $operation)
    {
        if($operation->user_id !== auth()->user()->id){
            return response()->json(['message' => 'Operation not created by this user'], 404);
        }

        return JsonResponseHelper::getResponseWithHeaders(new OperationResource($operation), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Operation $operation
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Operation $operation)
    {
        if($operation->user_id !== auth()->user()->id){
            return response()->json(['message' => 'Operation not created by this user'], 404);
        }

        $this->validate($request, [ 'sum' => 'required|min:1,max:100000', 'category_id' => 'required', 'description' => 'max:1000']);

        $result = $this->operationsService->updateOperation([
            'sum' => $request->input('sum'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description')
        ], $operation);

        if($result){
            return JsonResponseHelper::getResponseWithHeaders(['message' => 'Operation update success'], 200);
        } else {
            return JsonResponseHelper::getResponseWithHeaders(['message' => 'Operation update with error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Operation $operation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Operation $operation)
    {
        if($operation->user_id !== auth()->user()->id){
            return response()->json(['message' => 'Operation not created by this user'], 404);
        }

        $result = $this->operationsService->destroyOperation($operation);
        if($result){
            return JsonResponseHelper::getResponseWithHeaders(['message' => 'Operation delete success'], 200);
        } else {
            return JsonResponseHelper::getResponseWithHeaders(['message' => 'Operation not delete'], 200);
        }
    }
}