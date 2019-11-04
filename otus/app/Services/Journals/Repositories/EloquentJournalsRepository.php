<?php

namespace App\Services\Journals\Repositories;

use App\Models\Journal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentJournalsRepository implements JournalsRepositoryInterface {

    public function find(int $id) {
        return Journal::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Journal::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Journal::destroy($ids);
    }

    public function createFromArray(array $data): Journal {
        $journal = new Journal();
        $journal->fill($data);
        $journal->save();

        return $journal;
    }

    public function updateFromArray(Journal $journal, array $data): Journal {
        $journal->update($data);
        return $journal;
    }
}
