<?php

namespace App\Http\Controllers\Api\Trucks;

use App\Http\Resources\TrucksResource;
use App\Models\Transport\Truck;
use App\Services\TrucksService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrucksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $trucksService;

    public function __construct(TrucksService $trucksService)
    {
        $this->trucksService = $trucksService;
    }

    public function index()
    {
        $trucks = $this->trucksService->getAll();

        return response()->json($trucks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $truck = $this->trucksService->store($request);

        return response()->json(new TrucksResource($truck));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transport\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        return response()->json(new TrucksResource($truck));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transport\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        $this->trucksService->update($request, $truck);

        return response()->json(new TrucksResource($truck));
    }

    /**
     * @param Truck $truck
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Truck $truck)
    {
        $this->trucksService->destroy($truck);

        return response()->json([], 200);
    }
}
