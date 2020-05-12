<?php
/**
 * Eloquent репозиторий для доходов
 */

namespace App\Services\Income\Repositories;

use App\Models\Income;
use App\Services\Income\Repositories\IncomeRepositoryInterface;

class EloquentIncomeRepository implements IncomeRepositoryInterface
{


    /**
     * @param string $search
     * @param int $userId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($search = '', int $userId = 0)
    {
        $Incomes = Income::where('user_id', $userId);
        if ($search) {
            $Incomes->where('name', 'like', '%' . $search . '%');
        }
        return $Incomes->orderBy('id', 'desc')->paginate();
    }

    /**
     * @param string $search
     * @param int $userId
     * @return integer
     */
    public function sum($search = '', int $userId = 0)
    {
        $Incomes = Income::where('user_id', $userId);
        if ($search) {
            $Incomes->where('name', 'like', '%' . $search . '%');
        }
        return $Incomes->sum('summ');
    }

    /**
     * @param array $data
     * @return Income
     */
    public function createFromArray(array $data)
    {
        $income = new Income();
        $income->create($data);
        return $income;
    }

}
