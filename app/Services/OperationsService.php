<?php


namespace App\Services;

use App\Models\Operation;
use App\Repositories\OperationRepository;
use App\Handles\OperationsHandle;
use Carbon\Carbon;

class OperationsService
{
    protected $operationRepository;
    protected $operationsHandle;

    public function __construct(
        OperationRepository $operationRepository,
        OperationsHandle $operationsHandle
    )
    {
        $this->operationRepository = $operationRepository;
        $this->operationsHandle = $operationsHandle;
    }

    public function storeOperation($data){
        return $this->operationRepository->storeOperation($data);
    }

    public function updateOperation($data, Operation $operation){
        return $this->operationRepository->updateOperation($data, $operation);
    }

    public function destroyOperation($operation){
        return $this->operationRepository->destroyOperation($operation);
    }

    public function getUserTodayOperations($userId){
        return $this->operationRepository->getUserOperationsForPeriod($userId, Carbon::today(), Carbon::tomorrow());
    }

    public function getUserOperationsForPeriod($userId, $period){

        $period = $this->operationsHandle->defineDateStartDateEndForPeriod($period);
        $dateStart = $period['dateStart'];
        $dateEnd = $period['dateEnd'];

        return $this->operationRepository->getUserOperationsForPeriod($userId, $dateStart, $dateEnd);
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