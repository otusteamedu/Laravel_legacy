<?php

namespace App\Services\Students\Repositories;

use App\DTOs\IdDTO;
use App\DTOs\StudentDTO;
use App\DTOs\StudentFilterDTO;
use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentStudentRepository implements StudentRepositoryInterface
{
    /**
     * @param Student $student
     * @return bool
     * @throws Exception
     */
    public function delete(Student $student): bool
    {
        return $student->delete();
    }

    /**
     * @param StudentDTO $studentDTO
     * @param Student $student
     * @return Student
     */
    public function update(StudentDTO $studentDTO, Student $student): Student
    {
        $student->update($studentDTO->toArray());
        return $student;
    }

    /**
     * @param StudentDTO $DTO
     * @return Student
     */
    public function store(StudentDTO $DTO): Student
    {
        return Student::firstOrCreate($DTO->toArray());
    }

    /**
     * Список студентов с пагинацией
     * @param int $perPage
     * @param StudentFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getListPaginate(int $perPage, StudentFilterDTO $DTO): LengthAwarePaginator
    {
        $columns = [
            'students.id',
            'id_number',
            'user_id',
        ];

        $builder = Student::select($columns)
            ->whereHas('groups', function (Builder $builder): Builder {
                return $builder->select('id');
            })
            ->join('users', 'students.user_id', '=', 'users.id');
        $builder = $this->filter($builder, $DTO);
        $builder->with([
                'user:id,name,second_name,last_name',
                'groups:id,number,course_id',
                'groups.course:id,number',
            ])
            ->orderBy('last_name', 'ASC');

        $paginator = $this->paginate($builder, $perPage);

        return $paginator;
    }

    /**
     * @param Builder $builder
     * @param StudentFilterDTO $DTO
     * @return Builder
     */
    private function filter(Builder $builder, StudentFilterDTO $DTO): Builder
    {
        $filters = $DTO->toArray();
        if ($groupNumber = $filters[StudentFilterDTO::GROUP]) {
            $builder->whereHas('groups', function (Builder $builder) use ($groupNumber): void {
                $builder->whereId($groupNumber);
            });
        }
        if ($lastName = $filters[StudentFilterDTO::LAST_NAME]) {
            $builder->whereHas('user', function (Builder $builder) use ($lastName): void {
                $builder->lastName($lastName);
            });
        }
        if ($courseNumber = $filters[StudentFilterDTO::COURSE]) {
            $builder->whereHas('groups.course', function (Builder $builder) use ($courseNumber): void {
                $builder->whereId($courseNumber);
            });
        }
        if ($idNumber = $filters[StudentFilterDTO::ID_NUMBER]) {
            $builder->idNumber($idNumber);
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    private function paginate(Builder $builder, int $perPage): LengthAwarePaginator
    {
        return $builder->paginate($perPage);
    }

    /**
     * Обновить привязку студента к группам
     * @param Student $student
     * @param Collection $idDTOCollection
     * @param bool $detaching
     * @return Student
     */
    public function syncWithGroups(Student $student, Collection $idDTOCollection, bool $detaching = true): Student
    {
        $ids = $idDTOCollection->map(function (IdDTO $idDTO): int {
            return $idDTO->toArray()[IdDTO::ID];
        });

        $student->groups()->sync($ids, $detaching);

        return $student;
    }

    /**
     * @param StudentDTO $DTO
     * @return Student|null
     */
    public function getStudentByIdNumber(StudentDTO $DTO): ?Student
    {
        return Student::idNumber($DTO->toArray(StudentDTO::ID_NUMBER))->first();
    }

    /**
     * Получить список id групп студента
     * @param Student $student
     * @return array
     */
    public function getStudentGroupsId(Student $student): array
    {
        return $student->groups->pluck('id')->toArray();
    }
}
