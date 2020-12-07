<?php


namespace App\Services;

use Illuminate\Http\Request;
use \App\Models\Operation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OperationsService
{
    const PERIOD_TODAY = 'today';
    /**
     * @param Request $request
     * @return mixed
     */
    public function getOperationsForPeriod($period = self::PERIOD_TODAY){
        switch ($period){
            case 'today':
                $dateStart = Carbon::today();
                $dateEnd = Carbon::tomorrow();
                break;
            case 'yesterday':
                $dateStart = Carbon::yesterday();
                $dateEnd = Carbon::today();
                break;
            case 'week':
                $dateStart = Carbon::today()->subWeek();
                $dateEnd = Carbon::tomorrow();
                break;
            case 'month':
                $dateStart = Carbon::today()->subMonth();
                $dateEnd = Carbon::tomorrow();
                break;
            case 'quarter':
                $dateStart = Carbon::today()->subMonth(3);
                $dateEnd = Carbon::tomorrow();
                break;
            case 'year':
                $dateStart = Carbon::today()->subYear();
                $dateEnd = Carbon::tomorrow();
                break;
        }

        return Operation::where('user_id', Auth::id())->whereBetween('updated_at', [$dateStart, $dateEnd])->with('category')->get();
    }

    /**
     * Count of income and consumption for the period
     *
     * @param $operations
     * @return array
     */
    public function getIncomeConsumptionCount($operations){
        $incomeCount = 0;
        $consumptionCount = 0;
        foreach ($operations as $operation){
            if($operation->category->type == 1){
                $incomeCount += $operation->sum;
            } else {
                $consumptionCount += $operation->sum;
            }
        }
        return ['incomeCount' => $incomeCount, 'consumptionCount' => $consumptionCount];
    }
}