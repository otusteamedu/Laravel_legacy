<?php

namespace App\Services\Segments\Repositories;

use App\Models\Segment;

interface SegmentRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Segment;

    public function updateFromArray(Segment $segment, array $data);

}
