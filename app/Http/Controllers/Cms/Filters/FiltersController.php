<?php

namespace App\Http\Controllers\Cms\Filters;

use App\Http\Controllers\Cms\Filters\Requests\StoreFilterRequest;
use App\Http\Controllers\Cms\Filters\Requests\UpdateFilterRequest;
use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Policies\Abilities;
use App\Services\FilterTypes\FilterTypesService;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;
use View;
use App\Services\Filters\FiltersService;
use Illuminate\Http\Request;

class FiltersController extends Controller
{

    private FiltersService $filtersService;
    private FilterTypesService $filtersTypeService;

    public function __construct(
        FiltersService $filtersService,
        FilterTypesService $filtersTypeService
    )
    {
        $this->filtersService = $filtersService;
        $this->filtersTypeService = $filtersTypeService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$route = Route::current()->uri();
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();
        dd($route, $name, $action);*/
//        $this->getCurrentUser()->can(Abilities::VIEW_ANY, Filter::class);
        // Вариант использования
        /*if ($this->getCurrentUser()->cant(Abilities::VIEW_ANY, Filter::class)){
            abort(403, 'Action forbiden');
        }*/
        $this->authorize(Abilities::VIEW_ANY, Filter::class);

//// Cache whole page view ////////////////
       /* $key = $request->user()->id . '|' . $request->getUri();
        return Cache::remember($key, 60, function (){

            $filters = $this->filtersService->searchCachedFiltersWithFilterTypes([]);
            return view('cms.filters.index', [
                'filters' => $filters
            ])->render();
        });*/
///// END Cache whole page //////////

///  Cache with cache manager
        $filters = $this->filtersService->searchCachedFiltersWithFilterTypes([]);

        /// without cache
//        $filters = $this->filtersService->search([]);
        View::share([
            'filters' => $filters
        ]);
        return view('cms.filters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        View::share([
            'filterTypeList' => $this->filtersTypeService->getForCombobox()
        ]);
        return view('cms.filters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Controllers\Cms\Filters\Requests\StoreFilterRequest $request
     *
     */
    public function store(StoreFilterRequest $request)
    {
        $this->authorize(Abilities::CREATE, Filter::class);
        //Create now
//        $filter = $this->filtersService->create($request->getFormData());
        //Create with delay for Job test
        $filter =  $this->filtersService->createInQueue($request->getFormData());
        $filter->id = 'In Queue';
            return redirect()
                ->route('cms.filters.index')
                ->with(['success' => __('messages.rec_created', ['id' => $filter->id])]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Filter $filter)
    {
        dd($filter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        $this->authorize(Abilities::VIEW_ANY, Filter::class);
      /*  if (!isset($filter)) {
            abort(404); // Never catch it!!!
        }*/
        View::share([
            'filter' => $filter,
            'filterTypeList' => $this->filtersTypeService->getForCombobox()
        ]);
        return view('cms.filters.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Filter $filter
     */
    public function update(UpdateFilterRequest $request, Filter $filter)
    {
        $this->authorize(Abilities::UPDATE, $filter);
        $this->filtersService->update($filter, $request->getFormData());
        return redirect()
            ->route('cms.filters.index')
            ->with(['success' => __('messages.rec_updated', ['id' => $filter->id])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Filter $filter
     *
     */
    public function destroy(Filter $filter)
    {
        $this->authorize(Abilities::DELETE, $filter);

//        $result = Filter::where('id', $id)->forceDelete();
        $result = $filter->delete();
//        $result = Filter::find($id)->delete();
//        dd($result);
//        $result->delete();
//        dd($result);
//        $result = Filter::destroy($id);
            return redirect()
                ->route('cms.filters.index')
                ->with(['success' => __('messages.rec_deleted', ['id' => $filter->id])]);

    }
}
