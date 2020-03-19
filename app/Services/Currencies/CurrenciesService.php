<?php
/**
 * Сервис для работы с валютами
 */

namespace App\Services\Currencies;

use App\Models\Currency;
use App\Services\Currencies\Handlers\CreateCurrencyHandler;
use App\Services\Currencies\Handlers\UpdateCurrencyHandler;
use App\Services\Currencies\Handlers\DeleteCurrencyHandler;
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

    public function __construct(
        CreateCurrencyHandler $createCurrencyHandler,
        UpdateCurrencyHandler $updateCurrencyHandler,
        DeleteCurrencyHandler $deleteCurrencyHandler,
        CurrencyRepositoryInterface $currencyRepository
    )
    {
        $this->createHandler = $createCurrencyHandler;
        $this->updateHandler = $updateCurrencyHandler;
        $this->deleteHandler = $deleteCurrencyHandler;
        $this->repository = $currencyRepository;
    }

    /**
     * Получение по ид
     * @param int $id
     * @return array|null
     */
    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Поиск и выдача результата
     * @param string $code код валюты
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByCode($code): LengthAwarePaginator
    {
        return $this->repository->searchByCode($code);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(): array
    {
        return $this->repository->all();
    }


    /**
     * Сохранение валюты
     * @param array $data
     * @return Currency
     */
    public function store(array $data)
    {
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
        return $this->updateHandler->handle($id, $data);
    }

    /**
     * Удаление валюты
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->deleteHandler->handle($id);
    }


}
