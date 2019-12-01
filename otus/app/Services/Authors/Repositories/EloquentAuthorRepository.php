<?php

namespace App\Services\Authors\Repositories;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentAuthorRepository implements AuthorRepositoryInterface {

    public function find(int $id) {
        return Author::query()->find($id);
    }

    public function search(array $filters = [], array $with = []): LengthAwarePaginator {
        return Author::query()
            ->orderByDesc('created_at')
            ->with($with)
            ->paginate();
    }

    public function destroy(array $ids) {
        return Author::destroy($ids);
    }

    public function createFromArray(array $data):Author {
        $author = new Author();
        $author->fill($data);
        $author->save();

        return $author;
    }

    public function updateFromArray(Author $author, array $data):Author {
        $author->update($data);
        return $author;
    }
}
