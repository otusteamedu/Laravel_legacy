<?php
/**
 * Хэндлер для изменения валют
 */

namespace App\Services\Currencies\Handlers;


use App\Models\Currency;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use Carbon\Carbon;

class UpdateCurrencyHandler
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
     * @param array $data
     * @return bool
     */
    public function handle(int $id, array $data): int
    {
        $data['code'] = strtoupper($data['code']);
        return $this->currencyRepository->updateFromArray($id, $data);
    }

}
