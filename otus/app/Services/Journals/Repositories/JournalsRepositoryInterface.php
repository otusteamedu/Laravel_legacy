<?php

namespace App\Services\Journals\Repositories;

use App\Models\Journal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface JournalsRepositoryInterface {
    public function find(int $id);

    public function search(array $filters = [], array $with = []): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Journal;

    public function updateFromArray(Journal $journal, array $data): Journal;
}
