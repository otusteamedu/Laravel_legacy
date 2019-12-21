<?php

declare(strict_types=1);

namespace App\Services\Workout\Interfaces;

use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface WorkoutRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 * @todo Добавить тайпхинты для возвращаемых значений
 * @todo Разбить интерфейс на несколько меньших интерфейсов для соответствия ISP
 */
interface WorkoutRepositoryInterface
{
    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @return Workout|Collection|static[]|static|null
     */
    public function search(array $conditions = []);

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Workout|Collection|static[]|static|null
     */
    public function findById(int $id);

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Workout|static
     */
    public function create(array $data);

    /**
     * Update a record and fill it with values.
     *
     * @param  Workout  $workout
     * @param  array  $data
     * @return Workout|static
     */
    public function update(Workout $workout, array $data);

    /**
     * Delete a record from the database.
     *
     * @param  Workout  $workout
     * @return mixed
     */
    public function delete(Workout $workout);

}
