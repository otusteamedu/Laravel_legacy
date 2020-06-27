<?php

namespace App\DTOs;

class UserDTO implements DTOInterface
{
    const LAST_NAME = 'last_name';
    const NAME = 'name';
    const ROLE_ID = 'role_id';
    const SECOND_NAME = 'second_name';
    const EMAIL = 'email';
    const PASSWORD = 'password';

    /** @var string  */
    private $last_name;
    /** @var string  */
    private $name;
    /** @var string|null  */
    private $second_name;
    /** @var int|null  */
    private $email;
    /** @var int|null  */
    private $password;
    /** @var int  */
    private $role_id;

    /**
     * UserDTO constructor.
     * @param string $lastName
     * @param string $name
     * @param int $roleId
     * @param string|null $secondName
     * @param int|null $email
     * @param int|null $password
     */
    private function __construct(
        string $lastName,
        string $name,
        int $roleId,
        string $secondName = null,
        int $email = null,
        int $password = null
    ) {
        $this->last_name = $lastName;
        $this->name = $name;
        $this->second_name = $secondName;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $roleId;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static(
            $data[static::LAST_NAME],
            $data[static::NAME],
            $data[static::ROLE_ID],
            $data[static::SECOND_NAME] ?? null,
            $data[static::EMAIL] ?? null,
            $data[static::PASSWORD] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::LAST_NAME => $this->last_name,
            static::NAME => $this->name,
            static::SECOND_NAME => $this->second_name,
            static::EMAIL => $this->email,
            static::PASSWORD => $this->password,
            static::ROLE_ID => $this->role_id,
        ];
    }
}
