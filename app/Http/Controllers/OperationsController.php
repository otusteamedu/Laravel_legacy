<?php

namespace App\Http\Controllers;

use App\Services\OperationsService;
use App\Models\Operation;
use App\Services\CategoriesService;
use App\Services\Cache\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Jobs\StoreOperation;
use App\Jobs\Queues;

class OperationsController extends Controller
{
    protected $operationsService;
    protected $categoriesService;
    protected $tag;

    const CACHE_SET_TIME_IN_SECONDS = 600;

    public function __construct(
        OperationsService $operationsService,
        CategoriesService $categoriesService,
        Tag $tag
    ){
        $this->operationsService = $operationsService;
        $this->categoriesService = $categoriesService;
        $this->tag = $tag;
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
        return view('users.operations.create', ['categories' =>  $this->categoriesService->getAllCategories()]);
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

        StoreOperation::dispatch($data, $this->operationsService)->onQueue(Queues::STORE_OPERATION);
        Cache::tags([$this->tag::OPERATIONS, $this->tag::INCOME_COUNT, $this->tag::CONSUMPTION_COUNT])->flush();

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
        return view('users.operations.edit', ['operation' => $operation, 'categories' => $this->categoriesService->getAllCategories()]);
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

        Cache::tags([$this->tag::OPERATIONS, $this->tag::INCOME_COUNT, $this->tag::CONSUMPTION_COUNT])->flush();

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

        Cache::tags([$this->tag::OPERATIONS, $this->tag::INCOME_COUNT, $this->tag::CONSUMPTION_COUNT])->flush();

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

        if(!Cache::has('operations_'.$period)){
            $operations = $this->operationsService->getUserOperationsForPeriod(Auth::id(), $period);
            Cache::tags([$this->tag::OPERATIONS])->put('operations_'.$period, $operations, self::CACHE_SET_TIME_IN_SECONDS);
        } else {
            $operations = Cache::get('operations_'.$period);
        }

        if(!Cache::has('incomeCount_'.$period) || !Cache::has('consumptionCount_'.$period)){
            $incomeConsumptionCount = $this->operationsService->getIncomeConsumptionCount($operations);
            Cache::tags([$this->tag::INCOME_COUNT])->put('incomeCount_'.$period, $incomeConsumptionCount['incomeCount'], self::CACHE_SET_TIME_IN_SECONDS);
            Cache::tags([$this->tag::CONSUMPTION_COUNT])->put('consumptionCount_'.$period, $incomeConsumptionCount['consumptionCount'], self::CACHE_SET_TIME_IN_SECONDS);
        }

        return json_encode([
            'operations' => $operations,
            'incomeCount' => Cache::get('incomeCount_'.$period),
            'consumptionCount' =>  Cache::get('consumptionCount_'.$period)], JSON_UNESCAPED_UNICODE);
    }
}
