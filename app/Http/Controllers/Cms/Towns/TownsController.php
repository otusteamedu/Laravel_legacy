<?php

namespace App\Http\Controllers\Cms\Towns;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Towns\Request\StoreTownRequest;
use App\Models\Town;
use App\Services\Towns\TownsService;
use Illuminate\Http\Request;

class TownsController extends Controller
{
    protected $townService;

    public function __construct(TownsService $townService)
    {
        $this->townService = $townService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $townList = $this->townService->showTownList();
        return view('cms.towns.index', ['townList'=>$townList]);
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
     * @param  StoreTownRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTownRequest $request)
    {
        $data = $request->getFormData();
        $this->townService->storeTown($data);

        return redirect(route('towns.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Town $town
     * @return void
     */
    public function show(Town $town)
    {
        return view('cms.towns.show',compact('town',$town));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Town $town
     * @return void
     */
    public function edit(Town $town)
    {
        return view('cms.towns.edit',compact('town',$town));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTownRequest $request
     * @param Town $town
     * @return void
     */
    public function update(StoreTownRequest $request, Town $town)
    {
        $this->townService->updateTown($town, $request->all());

        return redirect(route('towns.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Town $town
     * @return void
     */
    public function destroy(Request $request, Town $town)
    {
        $this->townService->deleteTown($town);

        return redirect(route('towns.index'));
    }
}
