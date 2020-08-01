<?php

namespace App\Services\BusinessTypes\DTOs;

class BusinessTypeDTO
{
    private int $user_id;
    private int $type_id;
    private int $status;

    private function __construct(
        int $user_id,
        int $type_id,
        int $status
    )
    {
        $this->user_id = $user_id;
        $this->type_id = $type_id;
        $this->status = $status;
    }

    public static function fromArray(array $data)
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
