<?php

namespace App\Services\Handbooks\Repositories;

use App\Models\Handbook;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HandbookRepository {

    public function find(int $id) {
        return Handbook::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Handbook::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Handbook::destroy($ids);
    }

    public function createFromArray(array $data) {
        $author = new Handbook();
        $author->fill($data);
        $author->save();

        return $author;
    }

    public function updateFromArray(Handbook $author, array $data) {
        $author->update($data);
        return $author;
    }
}
