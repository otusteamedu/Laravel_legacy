<?php
/**
 * Сервис для работы со странами
 */

namespace App\Services\Countries;

use App\Models\Country;
use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Handlers\UpdateCountryHandler;
use App\Services\Countries\Handlers\DeleteCountryHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountriesService
{

    /** @var CountryRepositoryInterface */
    private $repository;

    /** @var CachedCountryRepositoryInterface */
    private $cachedRepository;

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
        CachedCountryRepositoryInterface $cachedCountryRepository,
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->createHandler = $createCountryHandler;
        $this->updateHandler = $updateCountryHandler;
        $this->deleteHandler = $deleteCountryHandler;
        $this->repository = $countryRepository;
        $this->cachedRepository = $cachedCountryRepository;
    }

    /**
     * Поиск и выдача резултата по таблице стран
     * @param string $name фильтр по наименованию страны
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByNames($name): LengthAwarePaginator
    {
        return $this->cachedRepository->searchByNames($name);
    }

    /**
     * Создание страны
     * @param array $data
     * @return Country
     */
    public function store(array $data)
    {
        $this->cachedRepository->clearSearchCache();
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
        $this->cachedRepository->clearSearchCache();
        return $this->updateHandler->handle($id, $data);
    }

    /**
     * Удаление страны
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $this->cachedRepository->clearSearchCache();
        return $this->deleteHandler->handle($id);
    }

}
