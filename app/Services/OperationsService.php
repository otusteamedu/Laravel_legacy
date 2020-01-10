<?php


namespace App\Services;

use App\Models\Operation;
use App\Repositories\OperationRepository;
use Carbon\Carbon;

class OperationsService
{
    protected $operationRepository;

    public function __construct(OperationRepository $operationRepository)
    {
        $this->operationRepository = $operationRepository;
    }

    public function storeOperation($data, Operation $operation){
        $this->operationRepository->storeOperation($data, $operation);
    }

    public function updateOperation($data, Operation $operation){
        $this->operationRepository->updateOperation($data, $operation);
    }

    public function destroyOperation($id, Operation $operation){
        $this->operationRepository->destroyOperation($id, $operation);
    }

    public function getUserTodayOperations($userId){

        $dateStart = Carbon::today();
        $dateEnd = Carbon::tomorrow();

        return $this->operationRepository->getUserOperationsForPeriod($userId, $dateStart, $dateEnd);

    }

    public function getUserOperationsForPeriod($userId, $period){

        $period = self::defineDateStartDateEndForPeriod($period);
        $dateStart = $period['dateStart'];
        $dateEnd = $period['dateEnd'];

        return $this->operationRepository->getUserOperationsForPeriod($userId, $dateStart, $dateEnd);
    }

    public function defineDateStartDateEndForPeriod($period){
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

        return ['dateStart' => $dateStart, 'dateEnd' => $dateEnd];

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