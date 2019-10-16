<?php

namespace App\Http\Controllers\Handbooks;

use App\Models\Handbook;
use App\Services\Handbooks\HandbookService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HandbooksController extends Controller {

    protected $handbookService;

    public function __construct(HandbookService $handbooksService) {
        $this->handbookService = $handbooksService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return \view('handbooks.list', [
            'handbooks' => $this->handbookService->searchHandbooks()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('handbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->handbookService->storeHandbook($request->all());
        return redirect(route('admin.handbooks.index'), '301');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Handbook $handbook
     * @return \Illuminate\Http\Response
     */
    public function show(Handbook $handbook) {
        return view('handbooks.show', [
            'handbook' => $handbook
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Handbook $handbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Handbook $handbook) {
        return view('handbooks.edit', [
            'handbook' => $handbook
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Handbook $handbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Handbook $handbook) {
        $this->handbookService->updateHandbook($handbook, $request->all());
        return redirect(route('admin.handbooks.index'), '301');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Handbook $handbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handbook $handbook) {
        $this->handbookService->destroyHandbook([$handbook->id]);
    }
}
