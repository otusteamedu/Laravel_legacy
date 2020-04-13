<?php


namespace App\Services\FilterTypes\Repositories;


interface FilterTypeRepositoryInterface
{
//    public function find(int $id): ?FilterType;

//    public function findBySlugAndLocale(string $slug, string $locale);

    public function search(array $filters): LengthAwarePaginator;

//    public function createFromArray(array $data): FilterType;

//    public function updateFromArray(FilterType $model, array $data): FilterType;

//    public function delete(FilterType $model);

    public function getForCombobox();

}
