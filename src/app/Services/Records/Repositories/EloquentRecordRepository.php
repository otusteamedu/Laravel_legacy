<?php

namespace App\Services\Records\Repositories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Collection;

class EloquentRecordRepository implements RecordRepositoryInterface
{

    public function find(int $id): ?Record
    {
        return Record::find($id);
    }

    public function findByBusinessId(int $business_id): ?Collection
    {
        return Record::whereBusinessId($business_id)->get();
    }
}
