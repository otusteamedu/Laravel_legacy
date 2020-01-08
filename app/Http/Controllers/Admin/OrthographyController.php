<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orthography;
use Illuminate\Http\Request;
use App\Services\Orthography\OrthographyService;
use App\Policies\Abilities;

//use Illuminate\Support\Facades\Storage;
//use Form;
//use App;
//use App\File;

class OrthographyController extends Controller
{
    private $orthographyService;

    public function __construct(
        OrthographyService $orthographyService
    )
    {
        $this->orthographyService = $orthographyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->orthographyService->list();
        return view('admin.orthography.list')->with(['list' => $list]);
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
     * @param \App\Models\Orthography $orthography
     * @return \Illuminate\Http\Response
     */
    public function show(Orthography $orthography)
    {
        return view('admin.orthography.detail')->with(['detail' => $orthography]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Orthography $orthography
     * @return \Illuminate\Http\Response
     */
    public function edit(Orthography $orthography)
    {

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orthography $orthography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orthography $orthography)
    {
        $this->authorize(Abilities::UPDATE, $orthography);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);

        $data = $request->all();
        $file = $request->file();
        $this->orthographyService->update($orthography, $data,$file);

        return view('admin.orthography.detail')->with(['detail' => $orthography]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Orthography $orthography
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orthography $orthography)
    {
        //
    }
}
