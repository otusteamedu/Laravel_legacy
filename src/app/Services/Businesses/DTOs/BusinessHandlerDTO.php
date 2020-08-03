<?php

namespace App\Services\Businesses\DTOs;

class BusinessHandlerDTO
{
    private string $name;
    private int $type_id;
    private int $status = 1;
    private int $user_id;

    private function __construct(
        string $name,
        int $type_id,
        int $user_id
    )
    {
        $this->name = $name;
        $this->type_id = $type_id;
        $this->user_id = $user_id;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['type_id'],
            $data['user_id']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type_id' => $this->type_id,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];
    }
}
