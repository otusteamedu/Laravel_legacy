<?php
/**
 * Хэндлер для удаления валют
 */

namespace App\Services\Currencies\Handlers;


use App\Models\Currency;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use Carbon\Carbon;

class DeleteCurrencyHandler
{

    private $currencyRepository;

    public function __construct(
        CurrencyRepositoryInterface $currencyRepository
    )
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function handle(int $id): bool
    {
        return $this->currencyRepository->delete($id);
    }

}
