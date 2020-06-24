<?php

namespace App\Http\Controllers\Api\Cms\Filters;

use App\Http\Controllers\Api\Cms\Filters\Resources\FilterResource;
use App\Http\Controllers\Api\Cms\Filters\Resources\FiltersResource;
use App\Http\Controllers\Api\Cms\Filters\Resources\FilterWithFilterTypesResource;
use App\Http\Controllers\Api\Cms\FilterTypes\Resources\FilterTypeResource;
use App\Http\Controllers\Api\Cms\FilterTypes\Resources\FilterTypesResource;
use App\Http\Controllers\Cms\Filters\Requests\StoreFilterRequest;
use App\Http\Controllers\Cms\Filters\Requests\UpdateFilterRequest;
use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Policies\Abilities;
use App\Services\Filters\FiltersService;
use App\Services\FilterTypes\FilterTypesService;
use http\Env\Response;
use Illuminate\Http\Request;
use Kint\Kint;

class FiltersController extends Controller
{

    /**
     * @var FiltersService
     */
    private FiltersService $filtersService;
    /**
     * @var FilterTypesService
     */
    private FilterTypesService $filterTypesService;

    public function __construct(FiltersService $filtersService, FilterTypesService $filterTypesService)
    {

        $this->filtersService = $filtersService;
        $this->filterTypesService = $filterTypesService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Filter::class);
        $filters = $this->filtersService->getAll();
//        return response()->json(new FiltersResource($filters));
//        return response()->json(FilterResource::collection($filters));
        return new FiltersResource($filters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilterRequest $request)
    {
        $this->authorize(Abilities::CREATE, Filter::class);
        /*$request->validate([
            'name' => 'required|min:5'
        ]);*/
        //Create now
//        $filter = Filter::create($request->all());
//        $filter = Filter::create($request->getFormData());
        $filter = $this->filtersService->create($request->getFormData());
        return response()->json(new FilterWithFilterTypesResource($filter), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Filter $filter)
    {
        $this->authorize(Abilities::VIEW_ANY, Filter::class);
//        return response()->json($filter);
//        return response()->json(new FilterResource($filter));
        // Set status and custom header
        return response()->json(new FilterWithFilterTypesResource($filter),
            202, ['X-Header-One' => 'Header Value']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateFilterRequest $request, Filter $filter)
    {
        $this->authorize(Abilities::UPDATE, $filter);
//        $filter = $filter->update($request->all());
        $this->filtersService->update($filter, $request->getFormData());
//        return response()->json(['OK']);
        return response()->json(new FilterResource($filter),201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Filter $filter)
    {
        $this->authorize(Abilities::DELETE, $filter);
        $result = $filter->delete();
        if(!$result){
            return response()->json(['message' => 'Something wrong'], 401);
        }
        return response()->json(['success' => __('messages.rec_deleted', ['id' => $filter->id])]);
    }
}
