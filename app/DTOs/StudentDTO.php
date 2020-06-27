<?php

namespace App\DTOs;

class StudentDTO implements DTOInterface
{
    const ID_NUMBER = 'id_number';
    const USER_ID = 'user_id';

    /** @var int  */
    private $id_number;
    /** @var int  */
    private $user_id;

    /**
     * StudentDTO constructor.
     * @param int $idNumber
     * @param int $userId
     */
    private function __construct(int $idNumber, int $userId)
    {
        $this->id_number = $idNumber;
        $this->user_id = $userId;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static($data[static::ID_NUMBER], $data[static::USER_ID]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::ID_NUMBER => $this->id_number,
            static::USER_ID => $this->user_id,
        ];
    }
}
