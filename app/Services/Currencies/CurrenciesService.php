<?php
/**
 * Сервис для работы с валютами
 */

namespace App\Services\Currencies;

use App\Models\Currency;
use App\Services\Currencies\Handlers\CreateCurrencyHandler;
use App\Services\Currencies\Handlers\UpdateCurrencyHandler;
use App\Services\Currencies\Handlers\DeleteCurrencyHandler;
use App\Services\Currencies\Repositories\CachedCurrencyRepositoryInterface;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CurrenciesService
{

    /** @var CurrencyRepositoryInterface */
    private $repository;
    /** @var CreateCurrencyHandler */
    private $createHandler;
    /** @var UpdateCurrencyHandler */
    private $updateHandler;
    /** @var DeleteCurrencyHandler */
    private $deleteHandler;

    /** @var CachedCurrencyRepositoryInterface */
    private $cachedRepository;

    public function __construct(
        CreateCurrencyHandler $createCurrencyHandler,
        UpdateCurrencyHandler $updateCurrencyHandler,
        DeleteCurrencyHandler $deleteCurrencyHandler,
        CurrencyRepositoryInterface $currencyRepository,
        CachedCurrencyRepositoryInterface $cachedCurrencyRepository
    )
    {
        $this->createHandler = $createCurrencyHandler;
        $this->updateHandler = $updateCurrencyHandler;
        $this->deleteHandler = $deleteCurrencyHandler;
        $this->repository = $currencyRepository;
        $this->cachedRepository = $cachedCurrencyRepository;
    }

    /**
     * Поиск и выдача результата
     * @param string $code код валюты
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByCode($code): LengthAwarePaginator
    {
        return $this->cachedRepository->searchByCode($code);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(): array
    {
        return $this->cachedRepository->all();
    }


    /**
     * Сохранение валюты
     * @param array $data
     * @return Currency
     */
    public function store(array $data)
    {
        $this->cachedRepository->clearSearchCache();
        return $this->createHandler->handle($data);
    }

    /**
     * Изменение валюты
     * @param int $id
     * @param array $data
     * @return Currency
     */
    public function update(int $id, array $data)
    {
        $this->cachedRepository->clearSearchCache();
        return $this->updateHandler->handle($id, $data);
    }

    /**
     * Удаление валюты
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $this->cachedRepository->clearSearchCache();
        return $this->deleteHandler->handle($id);
    }


}
