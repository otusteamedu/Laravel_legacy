<?php

namespace App\Http\Controllers;

use App\Repositories\OperationRepository;
use \App\Services\OperationsService;
use App\Models\Operation;
use App\Models\Category;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    private $operationService;
    private $operationRepository;

    public function __construct(OperationsService $operationService, OperationRepository $operationRepository){
        $this->operationService = $operationService;
        $this->operationRepository = $operationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = $this->operationService->getOperationsForPeriod();
        $incomeConsumptionCount = $this->operationService->getIncomeConsumptionCount($operations);

        return view('users.home', [
            'operations' => $operations,
            'incomeCount' => $incomeConsumptionCount['incomeCount'],
            'consumptionCount' => $incomeConsumptionCount['consumptionCount']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.operations.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Operation $operation)
    {
        $this->validate($request, [ 'sum' => 'required|min:0,max:100000', 'category_id' => 'required', 'description' => 'max:1000']);

        $this->operationRepository->store($request, $operation);

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        return view('users.operations.edit', ['operation' => $operation, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Operation $operation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Operation $operation)
    {
        $this->validate($request, [ 'sum' => 'required|min:0,max:100000', 'category_id' => 'required', 'description' => 'max:1000']);

        $this->operationRepository->update($request, $operation);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Operation $operation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Operation $operation)
    {
        $operation->destroy($operation->id);

        return redirect()->route('home');
    }

    /**
     * Period to show operations
     *
     * @param Request $request
     * @return false|string
     */
    public function setPeriod(Request $request){
        $all = $request->all();
        $period = $all['period'];

        $operations = $this->operationService->getOperationsForPeriod($period);
        $incomeConsumptionCount = $this->operationService->getIncomeConsumptionCount($operations);

        return json_encode([
            'operations' => $operations,
            'incomeCount' => $incomeConsumptionCount['incomeCount'],
            'consumptionCount' => $incomeConsumptionCount['consumptionCount']
        ], JSON_UNESCAPED_UNICODE);
    }
}
