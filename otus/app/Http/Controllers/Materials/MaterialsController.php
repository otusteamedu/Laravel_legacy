<?php

namespace App\Http\Controllers\Materials;

use App\Models\Material;
use App\Services\Authors\AuthorsService;
use App\Services\Categories\CategoryService;
use App\Services\Handbooks\HandbookService;
use App\Services\Materials\MaterialService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialsController extends Controller {

    protected $categoryService;
    protected $authorsService;
    protected $handbookService;
    protected $materialService;

    public function __construct(MaterialService $materialService, CategoryService $categoryService, AuthorsService $authorsService, HandbookService $handbookService) {
        $this->categoryService = $categoryService;
        $this->authorsService = $authorsService;
        $this->handbookService = $handbookService;
        $this->materialService = $materialService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return \view('materials.list', [
            'materials' => $this->materialService->searchMaterials()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('materials.create', [
            'categories' => $this->categoryService->searchCategories(),
            'authors' => $this->authorsService->searchAuthors(),
            'statuses' => $this->handbookService->searchHandbooks(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->materialService->storeMaterial($request->all());
        return redirect(route('admin.materials.index'), 301);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material) {
        return view('materials.show', [
            'material' => $material
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material) {
        return view('materials.edit', [
            'material' => $material,
            'categories' => $this->categoryService->searchCategories(),
            'authors' => $this->authorsService->searchAuthors(),
            'statuses' => $this->handbookService->searchHandbooks(),
        ]);
    }

    /**
     * @param Request $request
     * @param Material $material
     * @param AuthorsService $authorsService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Material $material) {
        $this->materialService->updateMaterial($material, $request->all());
        return redirect(route('admin.materials.index'), 301);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material) {
        $this->materialService->destroyMaterials([$material->id]);
    }
}
