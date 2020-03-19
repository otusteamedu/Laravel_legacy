<?php
/**
 * Сервис для работы со странами
 */

namespace App\Services\Countries;

use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Handlers\UpdateCountryHandler;
use App\Services\Countries\Handlers\DeleteCountryHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountriesService
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
     * @param string $name фильтр по наименованию страны
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByNames($name): LengthAwarePaginator
    {
        return $this->repository->searchByNames($name);
    }

    /**
     * Создание страны
     * @param array $data
     * @return Country
     */
    public function store(array $data)
    {
        return $this->createHandler->handle($data);
    }

    /**
     * Изменение страны
     * @param int $id
     * @param array $data
     * @return Country
     */
    public function update(int $id, array $data)
    {
        return $this->updateHandler->handle($id, $data);
    }

    /**
     * Удаление страны
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->deleteHandler->handle($id);
    }

}
