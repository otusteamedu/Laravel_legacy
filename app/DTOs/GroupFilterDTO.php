<?php

namespace App\DTOs;

class GroupFilterDTO implements DTOInterface
{
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
        $DTO->addCourse($data['course'] ?? null);
        $DTO->addTeacher($data['teacher'] ?? null);
        $DTO->addGroup($data['group'] ?? null);

        return $DTO;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'group' => $this->group,
            'teacher' => $this->teacher,
            'course' => $this->course,
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
