<?php

namespace App\Services\Procedures\DTOs;

class ProcedureCreateDTO
{
    private int $worker_id;
    private int $business_id;
    private int $duration;
    private int $price;
    private int $people_count;

    private function __construct(
        int $worker_id,
        int $business_id,
        int $duration,
        int $price,
        int $people_count
    ) {
        $this->worker_id = $worker_id;
        $this->business_id = $business_id;
        $this->duration = $duration;
        $this->price = $price;
        $this->people_count = $people_count;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['worker_id'],
            $data['business_id'],
            $data['duration'],
            $data['price'],
            $data['people_count'],
        );
    }

    public function toArray(): array
    {
        return [
            'worker_id' => $this->worker_id,
            'business_id' => $this->business_id,
            'duration' => $this->duration,
            'price' => $this->price,
            'people_count' => $this->people_count,
        ];
    }
}
