<?php

namespace App\Http\Controllers\Cms\Divisions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Divisions\Request\StoreDivisionRequest;
use App\Models\Division;
use App\Services\Divisions\DivisionsService;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{
    protected $divisionService;

    public function __construct(DivisionsService $divisionService)
    {
        $this->divisionService = $divisionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisionList = $this->divisionService->showDivisionList();
        return view('cms.divisions.index', ['divisionList'=>$divisionList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDivisionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDivisionRequest $request)
    {
        $data = $request->getFormData();
        $this->divisionService->storeDivision($data);

        return redirect(route('divisions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Division $division
     * @return void
     */
    public function show(Division $division)
    {
        return view('cms.divisions.show',compact('division',$division));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Division $division
     * @return void
     */
    public function edit(Division $division)
    {
        return view('cms.divisions.edit',compact('division',$division));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreDivisionRequest $request
     * @param Division $division
     * @return void
     */
    public function update(StoreDivisionRequest $request, Division $division)
    {
        $this->divisionService->updateDivision($division, $request->all());

        return redirect(route('divisions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Division $division
     * @return void
     */
    public function destroy(Request $request, Division $division)
    {
        $this->divisionService->deleteDivision($division);

        return redirect(route('divisions.index'));
    }
}
