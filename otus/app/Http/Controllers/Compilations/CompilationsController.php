<?php

namespace App\Http\Controllers\Compilations;

use App\Models\Compilation;
use App\Policies\Abilities;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, Compilation::class);

        return \view('compilations.list', [
            'compilations' => $this->compilationService->searchCompilations()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Compilation::class);

        return view('compilations.create', [
            'materials' => $this->materialService->searchMaterials(),
            'selectionMaterials' => $this->selectionMaterialService->searchSelectionMaterials(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Compilation::class);

        $this->compilationService->storeCompilation($request->all());
        return redirect(route('admin.compilations.index'), 301);
    }

    /**
     * @param Compilation $compilation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Compilation $compilation) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $compilation);

        return view('compilations.show', [
            'compilation' => $compilation
        ]);
    }

    /**
     * @param Compilation $compilation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Compilation $compilation) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $compilation);

        return view('compilations.edit', [
            'compilation' => $compilation,
            'selectionMaterials' => $this->selectionMaterialService->searchSelectionMaterials(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * @param Request $request
     * @param Compilation $compilation
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Compilation $compilation) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $compilation);

        $this->compilationService->updateCompilation($compilation, $request->all());
        return redirect(route('admin.compilations.index'), 301);
    }

    /**
     * @param Compilation $compilation
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Compilation $compilation) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::DELETE, $compilation);

        $this->compilationService->destroyCompilation([$compilation->id]);
    }
}
