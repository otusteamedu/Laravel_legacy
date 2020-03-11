<?php
/**
 * Сервис для работы со странами
 */

namespace App\Services\Countries;

use App\Services\BaseServiceInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Handlers\UpdateCountryHandler;
use App\Services\Countries\Handlers\DeleteCountryHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountriesService implements BaseServiceInterface
{

    /** @var CountryRepositoryInterface */
    private $repository;
    /** @var CreateCountryHandler */
    private $createHandler;
    /** @var UpdateCountryHandler */
    private $updateHandler;
    /** @var DeleteCountryHandler */
    private $deleteHandler;
    /** @var array  */
    private $errors = [];

    public function __construct(
        CreateCountryHandler $createCountryHandler,
        UpdateCountryHandler $updateCountryHandler,
        DeleteCountryHandler $deleteCountryHandler,
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->createHandler = $createCountryHandler;
        $this->updateHandler = $updateCountryHandler;
        $this->deleteHandler = $deleteCountryHandler;
        $this->repository = $countryRepository;
    }

    /**
     * Получение страны по ид
     * @param int $id
     * @return array|null
     */
    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Поиск и выдача резултата по таблице стран
     * @param array $filters
     * @param bool $like сравнивать по неполному соответствию
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($filters, $like = false): LengthAwarePaginator
    {
        return $this->repository->search($filters, $like);
    }

    /**
     * Создание страны
     * @param array $data
     * @return int
     */
    public function store(array $data)
    {
        if (!$this->checkDuplicate($data)) {
            return 0;
        }
        return $this->createHandler->handle($data);
    }

    /**
     * Изменение страны
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        if (!$this->checkDuplicate($data, $id)) {
            return false;
        }
        return $this->updateHandler->handle($id, $data);
    }

    /**
     * Удаление страны
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
     * Проберка на то что такая страна уже существует
     * @param array $search
     * @param int $currentId
     * @return bool
     */
    public function checkDuplicate($data, $currentId = 0) {
        $res = $this->repository->search(['name' => $data['name'] ?? '']);
        if (!empty($res[0]->id) && $res[0]->id != $currentId) {
            $this->errors[] = "Такая страна уже есть в базе (id = {$res[0]->id})!";
            return false;
        }
        $res = $this->repository->search(['name_eng' => $data['name_eng'] ?? '']);
        if (!empty($res[0]->id) && $res[0]->id != $currentId) {
            $this->errors[] = "Такая страна уже есть в базе (id = {$res[0]->id})!";
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
