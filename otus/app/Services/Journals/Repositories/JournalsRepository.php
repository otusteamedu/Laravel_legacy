<?php

namespace App\Services\Journals\Repositories;

use App\Models\Journal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class JournalsRepository {

    public function find(int $id) {
        return Journal::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Journal::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Journal::destroy($ids);
    }

    public function createFromArray(array $data) {
        $author = new Journal();
        $author->fill($data);
        $author->save();

        return $author;
    }

    public function updateFromArray(Journal $author, array $data) {
        $author->update($data);
        return $author;
    }
}
