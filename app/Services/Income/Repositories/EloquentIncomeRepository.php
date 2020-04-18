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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($search = '')
    {
        $userId = \Auth::user()->id;
        $Incomes = Income::where('user_id', $userId);
        if ($search) {
            $Incomes->where('name', 'like', '%' . $search . '%');
        }
        return $Incomes->orderBy('id', 'desc')->paginate();
    }

    /**
     * @param string $search
     * @return integer
     */
    public function sum($search = '')
    {
        $userId = \Auth::user()->id;
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
