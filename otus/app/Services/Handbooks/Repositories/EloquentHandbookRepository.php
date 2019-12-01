<?php

namespace App\Services\Handbooks\Repositories;

use App\Models\Handbook;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentHandbookRepository implements HandbookRepositoryInterface {

    public function find(int $id) {
        return Handbook::query()->find($id);
    }

    public function search(array $filters = [], array $with = []): LengthAwarePaginator {
        return Handbook::query()
            ->orderByDesc('created_at')
            ->with($with)
            ->paginate();
    }

    public function destroy(array $ids) {
        return Handbook::destroy($ids);
    }

    public function createFromArray(array $data): Handbook {
        $handbook = new Handbook();
        $handbook->fill($data);
        $handbook->save();

        return $handbook;
    }

    public function updateFromArray(Handbook $handbook, array $data): Handbook {
        $handbook->update($data);
        return $handbook;
    }
}
