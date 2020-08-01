<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Procedure\StoreProcedureRequest;
use App\Http\Requests\Procedure\UpdateProcedureRequest;
use App\Models\Procedure;
use App\Services\Admin\Businesses\BusinessService;
use App\Services\Admin\Procedures\ProcedureService;
use Illuminate\Support\Facades\Redirect;

class ProcedureController extends Controller
{
    /**
     * @var ProcedureService
     */
    private $service;
    /**
     * @var BusinessService
     */
    private $businessService;

    public function __construct(
        ProcedureService $service,
        BusinessService $businessService
    )
    {
        $this->service = $service;
        $this->businessService = $businessService;
    }

    /**
     * Страница со списком всех записей
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedures = $this->service->list();
        return view("admin.procedure.index", [
            'procedures' => $procedures
        ]);
    }

    /**
     * Форма добавления записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businesses = $this->businessService->list();
        return view('admin.procedure.create', [
            'procedure' => new Procedure(),
            'businesses' => $businesses
        ]);
    }

    /**
     * Добавление записи
     *
     * @param StoreProcedureRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProcedureRequest $request)
    {
        $this->service->create($request->getFormData());
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Страница с деталями записи
     * @param Procedure $procedure
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Procedure $procedure)
    {
        return view('admin.procedure.view', [
            'procedure' => $procedure,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Procedure $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedure $procedure)
    {
        $businesses = $this->businessService->list();

        return view('admin.procedure.edit', [
            'procedure' => $procedure,
            'businesses' => $businesses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProcedureRequest $request
     * @param $procedure
     * @return void
     */
    public function update(UpdateProcedureRequest $request, Procedure $procedure)
    {
        $this->service->update($request->getFormData(), $procedure);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $procedure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Procedure $procedure)
    {
        $this->service->delete($procedure);
        return Redirect::to(action([self::class, 'index']));
    }
}
