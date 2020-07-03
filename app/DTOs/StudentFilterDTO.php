<?php

namespace App\DTOs;

class StudentFilterDTO implements DTOInterface
{
    const ID_NUMBER = 'id_number';
    const LAST_NAME = 'last_name';
    const GROUP = 'group';
    const COURSE = 'course';

    /** @var int|null $idNumber */
    private $idNumber;
    /** @var string|null $user */
    private $lastName;
    /** @var  int|null */
    private $group;
    /** @var  int|null */
    private $course;

    /**
     * StudentFilterDTO constructor.
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
        $DTO->addIdNumber($data[static::ID_NUMBER] ?? null);
        $DTO->addLastName($data[static::LAST_NAME] ?? null);
        $DTO->addGroup($data[static::GROUP] ?? null);
        $DTO->addCourse($data[static::COURSE] ?? null);

        return $DTO;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::ID_NUMBER => $this->idNumber,
            static::LAST_NAME => $this->lastName,
            static::GROUP => $this->group,
            static::COURSE => $this->course,
        ];
    }

    /**
     * @param int|null $idNumber
     */
    private function addIdNumber(int $idNumber = null): void
    {
        $this->idNumber = $idNumber;
    }

    /**
     * @param string|null $lastName
     */
    private function addLastName(string $lastName = null): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param int|null $group
     */
    private function addGroup(int $group = null): void
    {
        $this->group = $group;
    }

    /**
     * @param int|null $course
     */
    private function addCourse(int $course = null): void
    {
        $this->course = $course;
    }
}
