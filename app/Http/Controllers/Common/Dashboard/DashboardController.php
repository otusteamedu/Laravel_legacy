<?php

namespace App\Http\Controllers\Common\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\Dashboard\Requests\StoreIncomeRequest;

use App\Services\Income\IncomesService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $incomesService;

    /**
     * Create a new controller instance.
     *
     * @param IncomesService $incomesService
     */

    public function __construct(IncomesService $incomesService)
    {
        $this->middleware('auth');
        $this->incomesService = $incomesService;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $incomes = $this->incomesService->search($search);
        $summ = $this->incomesService->sum($search);
        return view('index', [
            'incomes' => $incomes,
            'search' => $search,
            'summ' => $summ,
            'page' => 'index',
        ]);
    }

    /**
     * Сохранение дохода
     *
     * @param Request $request
     * @return string
     */
    public function store(StoreIncomeRequest $request): string
    {
        try {
            $country = $this->incomesService->store($request->all());
        } catch (\Exception $e) {
            \Log::channel('error')->error(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return response()->json($country,200)->send();
    }

}
