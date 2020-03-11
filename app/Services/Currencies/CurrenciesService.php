<?php
/**
 * Сервис для работы с валютами
 */

namespace App\Services\Currencies;

use App\Services\BaseServiceInterface;
use App\Services\Currencies\Handlers\CreateCurrencyHandler;
use App\Services\Currencies\Handlers\UpdateCurrencyHandler;
use App\Services\Currencies\Handlers\DeleteCurrencyHandler;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CurrenciesService implements BaseServiceInterface
{

    /** @var CurrencyRepositoryInterface */
    private $repository;
    /** @var CreateCurrencyHandler */
    private $createHandler;
    /** @var UpdateCurrencyHandler */
    private $updateHandler;
    /** @var DeleteCurrencyHandler */
    private $deleteHandler;
    /** @var array  */
    private $errors = [];

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
     * @param array $filters массив фильтров
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($filters): LengthAwarePaginator
    {
        return $this->repository->search($filters);
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
     * @return int
     */
    public function store(array $data)
    {
        if (!$this->checkDuplicate($data['code'])) {
            return 0;
        }
        return $this->createHandler->handle($data);
    }

    /**
     * Изменение валюты
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        if (!$this->checkDuplicate($data['code'], $id)) {
            return false;
        }
        return $this->updateHandler->handle($id, $data);
    }

    /**
     * Удаление валюты
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $result = $this->deleteHandler->handle($id);
        } catch (\Exception $e) {
            $this->errors = $e->getMessage();
            $result = false;
        }
        return $result;
    }


    /**
     * Проберка на то что такая валюта уже существует
     * @param string $code
     * @param int $currentId
     * @return bool
     */
    public function checkDuplicate($code, $currentId = 0) {
        $res = $this->repository->search(['code' => $code]);
        if (!empty($res[0]->id) && $res[0]->id != $currentId) {
            $this->errors[] = "Такая валюта уже есть в базе (id = {$res[0]->id})!";
            return false;
        }
        return true;
    }

    /**
     * Получение массива ошибок
     * @return array
     */
    public function getErrors()
    {
       return $this->errors;
    }

}
