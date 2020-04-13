<?php


namespace App\Services\FilterTypes\Repositories;


use App\Models\FilterType;

class EloquentFilterTypeRepository implements FilterTypeRepositoryInterface
{
    public function find(int $id): ?FilterType
    {
        return FilterType::find($id);
    }
   /* public function findBySlugAndLocale(string $slug, string $locale): ?FilterType
    {
        return FilterType::query()->whereSlug($slug)
            ->whereLocale($locale)
            ->first();
    }*/

    public function getForCombobox()
    {
        $columns = implode(', ',[
            'id',
            'CONCAT (id, ". ", name) AS id_name',
        ]);
        $result = FilterType::selectRaw($columns)
            ->get();
        return $result;
   }

    public function search(array $filters): LengthAwarePaginator
    {
        return FilterType::paginate();
    }

    /*public function createFromArray(array $data): FilterType
    {
        return FilterType::create($data);
    }*/

    public function updateFromArray(FilterType $model, array $data): FilterType
    {
        $model->update($data);
        return $model;
    }

    public function delete(FilterType $model)
    {
        $model->delete();
    }
}
