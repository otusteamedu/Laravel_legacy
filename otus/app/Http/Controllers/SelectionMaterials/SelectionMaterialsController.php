<?php

namespace App\Http\Controllers\SelectionMaterials;

use App\Models\SelectionMaterial;
use App\Services\SelectionMaterials\SelectionMaterialsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectionMaterialsController extends Controller {

    protected $selectionMaterialsService;

    public function __construct(SelectionMaterialsService $selectionMaterialsService) {
        $this->selectionMaterialsService = $selectionMaterialsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return \view('selection_materials.list', [
            'selectionMaterials' => $this->selectionMaterialsService->searchSelectionMaterial()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('selection_materials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->selectionMaterialsService->storeSelectionMaterial($request->all());
        return redirect(route('admin.selection-materials.index'), '301');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(SelectionMaterial $selectionMaterial) {
        return view('selection_materials.show', [
            'selectionMaterial' => $selectionMaterial
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(SelectionMaterial $selectionMaterial) {
        return view('selection_materials.edit', [
            'selectionMaterial' => $selectionMaterial
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SelectionMaterial $selectionMaterial) {
        $this->selectionMaterialsService->updateSelectionMaterial($selectionMaterial, $request->all());
        return redirect(route('admin.selection-materials.index'), '301');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SelectionMaterial $selectionMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(SelectionMaterial $selectionMaterial) {
        $this->selectionMaterialsService->destroySelectionMaterial([$selectionMaterial->id]);
    }
}
