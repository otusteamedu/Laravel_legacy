<?php

namespace App\Services\Businesses\DTOs;

class BusinessCreateDTO
{
    private string $name;
    private int $user_id;
    private int $type_id;
    private int $status;

    private function __construct(
        string $name,
        int $user_id,
        int $type_id,
        int $status
    )
    {
        $this->name = $name;
        $this->user_id = $user_id;
        $this->type_id = $type_id;
        $this->status = $status;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['user_id'],
            $data['type_id'],
            $data['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'user_id' => $this->user_id,
            'type_id' => $this->type_id,
            'status' => $this->status,
        ];
    }
}
