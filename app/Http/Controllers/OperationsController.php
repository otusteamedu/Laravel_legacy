<?php

namespace App\Http\Controllers;

use App\Services\OperationsService;
use App\Models\Operation;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    protected $operationsService;

    public function __construct(OperationsService $operationsService){
        $this->operationsService = $operationsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = $this->operationsService->getUserTodayOperations(Auth::id());
        $incomeConsumptionCount = $this->operationsService->getIncomeConsumptionCount($operations);

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
    public function store(Request $request)
    {
        $this->validate($request, [ 'sum' => 'required|numeric|min:1,max:100000', 'category_id' => 'required|integer', 'description' => 'string|max:1000|nullable']);

        $data = [
            'sum' => $request->input('sum'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
            ];

        $this->operationsService->storeOperation($data);

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
        $this->validate($request, [ 'sum' => 'required|min:1,max:100000', 'category_id' => 'required', 'description' => 'max:1000']);

        $data = [
            'sum' => $request->input('sum'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description')
        ];

        $this->operationsService->updateOperation($data, $operation);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Operation $operation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->operationsService->destroyOperation($id);

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

        $operations = $this->operationsService->getUserOperationsForPeriod(Auth::id(), $period);
        $incomeConsumptionCount = $this->operationsService->getIncomeConsumptionCount($operations);

        return json_encode([
            'operations' => $operations,
            'incomeCount' => $incomeConsumptionCount['incomeCount'],
            'consumptionCount' => $incomeConsumptionCount['consumptionCount']
        ], JSON_UNESCAPED_UNICODE);
    }
}
