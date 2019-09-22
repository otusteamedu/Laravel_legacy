<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = \App\Services\Operation::getOperationsForPeriod();
        $incomeConsumptionCount = \App\Services\Operation::getIncomeConsumptionCount($operations);

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
        return view('users.operations.create', ['categories' => \App\Models\Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \App\Models\Operation::create([
            'sum' => $request->input('sum'),
            'category_id' => $request->input('categoryId'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
        ]);

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

        return view('users.operations.edit', ['operation' => \App\Models\Operation::find($operation->id), 'categories' => \App\Models\Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        \App\Models\Operation::where('id', $operation->id)
            ->update([
                'sum' => $request->input('sum'),
                'category_id' => $request->input('categoryId'),
                'description' => $request->input('description'),
            ]);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($operation)
    {
        \App\Models\Operation::destroy($operation);

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

        $operations = \App\Services\Operation::getOperationsForPeriod($period);
        $incomeConsumptionCount = \App\Services\Operation::getIncomeConsumptionCount($operations);

        return json_encode([
            'operations' => $operations,
            'incomeCount' => $incomeConsumptionCount['incomeCount'],
            'consumptionCount' => $incomeConsumptionCount['consumptionCount']
        ], JSON_UNESCAPED_UNICODE);
    }
}
