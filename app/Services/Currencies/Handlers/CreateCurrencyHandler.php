<?php
/**
 * Хэндлер для добавления валют
 */

namespace App\Services\Currencies\Handlers;


use App\Models\Currency;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use Carbon\Carbon;

class CreateCurrencyHandler
{

    private $currencyRepository;

    public function __construct(
        CurrencyRepositoryInterface $currencyRepository
    )
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @param array $data
     * @return int
     */
    public function handle(array $data): int
    {
        $data['code'] = strtoupper($data['code']);
        return $this->currencyRepository->createFromArray($data);
    }

}
