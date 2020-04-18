<?php
/**
 * Хэндлер для добавления валют
 */

namespace App\Services\Income\Handlers;


use App\Models\Income;
use App\Services\Income\Repositories\IncomeRepositoryInterface;
use Carbon\Carbon;

class CreateIncomeHandler
{

    private $incomeRepository;

    public function __construct(
        IncomeRepositoryInterface $incomeRepository
    )
    {
        $this->incomeRepository = $incomeRepository;
    }

    /**
     * @param array $data
     * @return Income
     */
    public function handle(array $data): Income
    {
        $data['user_id'] = \Auth::user()->id;
        return $this->incomeRepository->createFromArray($data);
    }

}
