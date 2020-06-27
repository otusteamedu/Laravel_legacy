<?php

namespace App\DTOs;

class GroupFilterDTO implements DTOInterface
{
    const GROUP = 'group';
    const COURSE = 'teacher';
    const TEACHER = 'course';

    /** @var int|null $group*/
    private $group;
    /** @var string|null $teacher*/
    private $teacher;
    /** @var int|null $course*/
    private $course;

    /**
     * GroupFilterDTO constructor.
     */
    private function __construct()
    {
        //
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        $DTO = new static();
        $DTO->addCourse($data[static::COURSE] ?? null);
        $DTO->addTeacher($data[static::TEACHER] ?? null);
        $DTO->addGroup($data[static::GROUP] ?? null);

        return $DTO;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::GROUP => $this->group,
            static::TEACHER => $this->teacher,
            static::COURSE => $this->course,
        ];
    }

    /**
     * @param int|null $group
     */
    private function addGroup(int $group = null): void
    {
        $this->group = $group;
    }

    /**
     * @param string|null $teacher
     */
    private function addTeacher(string $teacher = null): void
    {
        $this->teacher = $teacher;
    }

    /**
     * @param int|null $course
     */
    private function addCourse(int $course = null): void
    {
        $this->course = $course;
    }
}
