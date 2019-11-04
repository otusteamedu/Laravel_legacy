<?php

namespace App\Http\Controllers\Handbooks;

use App\Models\Handbook;
use App\Policies\Abilities;
use App\Services\Handbooks\HandbookService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HandbooksController extends Controller {

    protected $handbookService;

    public function __construct(HandbookService $handbooksService) {
        $this->handbookService = $handbooksService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, Handbook::class);

        return \view('handbooks.list', [
            'handbooks' => $this->handbookService->searchHandbooks()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Handbook::class);

        return view('handbooks.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Handbook::class);

        $this->handbookService->storeHandbook($request->all());
        return redirect(route('admin.handbooks.index'), 301);
    }

    /**
     * @param Handbook $handbook
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Handbook $handbook) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $handbook);

        return view('handbooks.show', [
            'handbook' => $handbook
        ]);
    }

    /**
     * @param Handbook $handbook
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Handbook $handbook) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $handbook);

        return view('handbooks.edit', [
            'handbook' => $handbook
        ]);
    }

    /**
     * @param Request $request
     * @param Handbook $handbook
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Handbook $handbook) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $handbook);

        $this->handbookService->updateHandbook($handbook, $request->all());
        return redirect(route('admin.handbooks.index'), 301);
    }

    /**
     * @param Handbook $handbook
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Handbook $handbook) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::DELETE, $handbook);

        $this->handbookService->destroyHandbook([$handbook->id]);
    }
}
