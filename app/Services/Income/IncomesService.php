<?php
/**
 * Сервис для работы с доходами
 */

namespace App\Services\Income;

use App\Models\Income;
use App\Services\Income\Handlers\CreateIncomeHandler;
use App\Services\Income\Repositories\IncomeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IncomesService
{

    /** @var IncomeRepositoryInterface */
    private $repository;
    /** @var CreateIncomeHandler */
    private $createHandler;


    public function __construct(
        CreateIncomeHandler $createIncomeHandler,
        IncomeRepositoryInterface $incomeRepository
    )
    {
        $this->createHandler = $createIncomeHandler;
        $this->repository = $incomeRepository;
    }

    /**
     * Поиск и выдача результата
     * @param string $string поисковая строка
     * @return LengthAwarePaginator
     */
    public function search($string): LengthAwarePaginator
    {
        return $this->repository->search($string);
    }

    /**
     * Сумма дохода
     * @param string $string поисковая строка
     * @return int
     */
    public function sum($string): int
    {
        return $this->repository->sum($string);
    }


    /**
     * Сохранение дохода
     * @param array $data
     * @return Income
     */
    public function store(array $data)
    {
        return $this->createHandler->handle($data);
    }



}
