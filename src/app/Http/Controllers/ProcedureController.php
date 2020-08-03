<?php

namespace App\Http\Controllers;

use App\Http\Requests\Procedure\StoreProcedureRequest;
use App\Http\Requests\Procedure\UpdateProcedureRequest;
use App\Models\Procedure;
use App\Services\Procedures\ProcedureService;
use Illuminate\Support\Facades\Redirect;

class ProcedureController extends Controller
{
    /**
     * @var ProcedureService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ProcedureService $service
     * @return void
     */
    public function __construct(
        ProcedureService $service
    )
    {
        // TODO: Использовать через Gate
        $this->authorizeResource(Procedure::class, "procedure");

        $this->service = $service;
    }

    /**
     * Список процедур
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('procedure.index', [
            'procedures' => $this->service->getMyProcedures(),
        ]);
    }

    /**
     * Страница с деталями записи
     * @param Procedure $procedure
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Procedure $procedure)
    {
        return view('procedure.view', [
            'procedure' => $procedure,
        ]);
    }

    /**
     * Страница добавления процедур
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View+
     */
    public function create()
    {
        return view('procedure.create', [
            'procedure' => new Procedure(),
        ]);
    }

    /**
     * Добавление записи
     * @param StoreProcedureRequest $request
     * @return mixed
     */
    public function store(StoreProcedureRequest $request)
    {
        $this->service->create($request->getFormData());
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Форма редактирование записи
     * @param Procedure $procedure
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Procedure $procedure)
    {
        return view('procedure.edit', [
            'procedure' => $procedure,
        ]);
    }

    /**
     * Редактирование записи
     * @param UpdateProcedureRequest $request
     * @param Procedure $procedure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProcedureRequest $request, Procedure $procedure)
    {
        $this->service->update($request->getFormData(), $procedure);
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Удалить запись
     * @param Procedure $procedure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Procedure $procedure)
    {
        $this->service->delete($procedure);
        return Redirect::to(action([self::class, 'index']));
    }
}
