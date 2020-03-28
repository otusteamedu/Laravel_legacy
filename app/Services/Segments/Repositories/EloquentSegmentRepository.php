<?php

namespace App\Services\Segments\Repositories;

use App\Models\Segment;
use Illuminate\Database\Eloquent\Builder;

class EloquentSegmentRepository implements SegmentRepositoryInterface
{
    public function find(int $id)
    {
        return Segment::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Segment::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Segment
    {
        $segment = new Segment();
        $segment->create($data);
        return $segment;
    }

    public function updateFromArray(Segment $segment, array $data)
    {
        $segment->update($data);
        return $segment;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
