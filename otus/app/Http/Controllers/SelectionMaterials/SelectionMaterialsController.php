<?php

namespace App\Http\Controllers\SelectionMaterials;

use App\Models\SelectionMaterial;
use App\Policies\Abilities;
use App\Services\SelectionMaterials\SelectionMaterialsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectionMaterialsController extends Controller {

    protected $selectionMaterialsService;

    public function __construct(SelectionMaterialsService $selectionMaterialsService) {
        $this->selectionMaterialsService = $selectionMaterialsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, SelectionMaterial::class);

        return \view('selection_materials.list', [
            'selectionMaterials' => $this->selectionMaterialsService->searchSelectionMaterials()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, SelectionMaterial::class);

        return view('selection_materials.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, SelectionMaterial::class);

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->validate($request, [
            'name' => 'required',
        ]);

        $this->selectionMaterialsService->storeSelectionMaterial($request->all());
        return redirect(route('admin.selection-materials.index'), 301);
    }

    /**
     * @param SelectionMaterial $selectionMaterial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(SelectionMaterial $selectionMaterial) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $selectionMaterial);

        return view('selection_materials.show', [
            'selectionMaterial' => $selectionMaterial
        ]);
    }

    /**
     * @param SelectionMaterial $selectionMaterial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(SelectionMaterial $selectionMaterial) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $selectionMaterial);

        return view('selection_materials.edit', [
            'selectionMaterial' => $selectionMaterial
        ]);
    }

    /**
     * @param Request $request
     * @param SelectionMaterial $selectionMaterial
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, SelectionMaterial $selectionMaterial) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $selectionMaterial);

        $this->selectionMaterialsService->updateSelectionMaterial($selectionMaterial, $request->all());
        return redirect(route('admin.selection-materials.index'), 301);
    }

    /**
     * @param SelectionMaterial $selectionMaterial
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(SelectionMaterial $selectionMaterial) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::DELETE, $selectionMaterial);

        $this->selectionMaterialsService->destroySelectionMaterial([$selectionMaterial->id]);
    }
}
