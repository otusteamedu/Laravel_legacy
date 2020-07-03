<?php

namespace App\DTOs;

class TeacherFilterDTO implements DTOInterface
{
    const LAST_NAME = 'last_name';
    const EMAIL = 'email';
    const SUBJECT_ID = 'subject_id';

    /** @var string|null */
    private $lastName;
    /** @var string|null */
    private $email;
    /** @var int|null */
    private $subjectId;

    /**
     * TeacherFilterDTO constructor.
     * @param string|null $lastName
     * @param string|null $email
     * @param string|null $subjectId
     */
    private function __construct(
        string $lastName = null,
        string $email = null,
        string $subjectId = null
    ) {
        $this->lastName = $lastName;
        $this->email = $email;
        $this->subjectId = $subjectId;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static(
            $data[static::LAST_NAME] ?? null,
            $data[static::EMAIL] ?? null,
            $data[static::SUBJECT_ID] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::LAST_NAME => $this->lastName,
            static::EMAIL => $this->email,
            static::SUBJECT_ID => $this->subjectId,
        ];
    }
}
