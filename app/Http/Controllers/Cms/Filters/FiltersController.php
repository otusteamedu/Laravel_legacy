<?php

namespace App\Http\Controllers\Cms\Filters;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use View;
use App\Services\Filters\FiltersService;
use Illuminate\Http\Request;

class FiltersController extends Controller
{

    private $filtersService;

    public function __construct(
        FiltersService $filtersService
    )
    {
        $this->filtersService = $filtersService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = $this->filtersService->search([]) ;
//        dd($filters, $filters[0], $filters[0]['value'], $filters[0]->value);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        View::share([
            'filter' => $filter,
        ]);
        return view('cms.filters.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filter $filter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
//        dd(\request()->all());
//        dd($id);
//        $result = Filter::where('id', $id)->forceDelete();
        $result = Filter::find($id)->delete();
//        dd($result);
//        $result->delete();
//        dd($result);
//        $result = Filter::destroy($id);

        if ($result) {
            return redirect()
                ->route('cms.filters.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        } else {
            dd($result);
            return back()
                ->withErrors(['msg' => 'Ошибка удаления'])
                ->withInput();
        }
    }
}
