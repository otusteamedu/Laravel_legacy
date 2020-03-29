<?php

namespace App\Services\Pictures\Repositories;

use App\Models\Picture;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder ;


class EloquentPictureRepository implements PictureRepositoryInterface
{
    /**
     * @param int $id
     * @return Picture|Picture[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return Picture::find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function search(array $filters = []): LengthAwarePaginator
    {
        $picture = Picture::query();
        $this->applyFilters($picture, $filters);

        return $picture->paginate();
    }

    public function createFromArray(array $data): Picture
    {
        $picture = new Picture();
        try {
            $picture->fill($data)->save();
        } catch (\Throwable $exception) {
            // @ToDo: добавить логирование ошибки
            /*return 'Произошла ошибка при сохранении:'
                . $exception->getMessage();*/
            // @ToDo: прикрутить обработку ошибок и их вывод на экран
        }

        return $picture;
    }

    /**
     * @param Picture $picture
     * @param array $data
     * @return Picture
     */
    public function updateFromArray(Picture $picture, array $data)
    {
        $picture->update($data);

        return $picture;
    }

    /**
     * @param int $id
     */
    public function delete(int $id) {

    }

    /**
     * @param Builder $queryBuilder
     * @param array $filters
     */
    private function applyFilters(Builder $queryBuilder, array $filters) {

        if (isset($filters['path'])) {
            $queryBuilder->where('path', $filters['path']);
        }
    }
}
