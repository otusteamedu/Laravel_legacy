<?php

namespace App\Http\Controllers\Compilations;

use App\Models\Compilation;
use App\Services\Compilations\CompilationService;
use App\Services\Materials\MaterialService;
use App\Services\SelectionMaterials\SelectionMaterialsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompilationsController extends Controller {

    protected $compilationService;
    protected $materialService;
    protected $selectionMaterialService;

    public function __construct(CompilationService $compilationService, MaterialService $materialService, SelectionMaterialsService $selectionMaterialsService) {
        $this->compilationService = $compilationService;
        $this->materialService = $materialService;
        $this->selectionMaterialService = $selectionMaterialsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return \view('compilations.list', [
            'compilations' => $this->compilationService->searchCompilations()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('compilations.create', [
            'materials' => $this->materialService->searchMaterials(),
            'selectionMaterials' => $this->selectionMaterialService->searchSelectionMaterials(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->compilationService->storeCompilation($request->all());
        return redirect(route('admin.compilations.index'), 301);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Compilation $compilation
     * @return \Illuminate\Http\Response
     */
    public function show(Compilation $compilation) {
        return view('compilations.show', [
            'compilation' => $compilation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Compilation $compilation
     * @return \Illuminate\Http\Response
     */
    public function edit(Compilation $compilation) {
        return view('compilations.edit', [
            'compilation' => $compilation,
            'selectionMaterials' => $this->selectionMaterialService->searchSelectionMaterials(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compilation $compilation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compilation $compilation) {
        $this->compilationService->updateCompilation($compilation, $request->all());
        return redirect(route('admin.compilations.index'), 301);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Compilation $compilation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compilation $compilation) {
        $this->compilationService->destroyCompilation([$compilation->id]);
    }
}
