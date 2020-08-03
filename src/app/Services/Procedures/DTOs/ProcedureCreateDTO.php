<?php

namespace App\Services\Procedures\DTOs;

class ProcedureCreateDTO
{
    private string $name;
    private int $duration;
    private int $price;
    private int $people_count;

    private function __construct(
        string $name,
        int $duration,
        int $price,
        int $people_count
    ) {
        $this->name = $name;
        $this->duration = $duration;
        $this->price = $price;
        $this->people_count = $people_count;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['duration'],
            $data['price'],
            $data['people_count'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'duration' => $this->duration,
            'price' => $this->price,
            'people_count' => $this->people_count,
        ];
    }
}
