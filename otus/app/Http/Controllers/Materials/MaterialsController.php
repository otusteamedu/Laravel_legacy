<?php

namespace App\Http\Controllers\Materials;

use App\Models\Material;
use App\Policies\Abilities;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, Material::class);

        return \view('materials.list', [
            'materials' => $this->materialService->searchMaterials()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Material::class);

        return view('materials.create', [
            'categories' => $this->categoryService->searchCategories(),
            'authors' => $this->authorsService->searchAuthors(),
            'statuses' => $this->handbookService->searchHandbooks(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Material::class);

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
        ]);

        $this->materialService->storeMaterial($request->all());
        return redirect(route('admin.materials.index'), 301);
    }

    /**
     * @param Material $material
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Material $material) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $material);

        return view('materials.show', [
            'material' => $material
        ]);
    }

    /**
     * @param Material $material
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Material $material) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $material);

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Material $material) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $material);

        $this->materialService->updateMaterial($material, $request->all());
        return redirect(route('admin.materials.index'), 301);
    }

    /**
     * @param Material $material
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Material $material) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::DELETE, $material);

        $this->materialService->destroyMaterials([$material->id]);
    }
}
