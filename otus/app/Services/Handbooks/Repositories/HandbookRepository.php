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
        $handbook = new Handbook();
        $handbook->fill($data);
        $handbook->save();

        return $handbook;
    }

    public function updateFromArray(Handbook $handbook, array $data) {
        $handbook->update($data);
        return $handbook;
    }
}
