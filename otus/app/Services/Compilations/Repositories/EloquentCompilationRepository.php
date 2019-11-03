<?php

namespace App\Services\Compilations\Repositories;

use App\Models\Compilation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentCompilationRepository implements CompilationRepositoryInterface {

    public function find(int $id) {
        return Compilation::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Compilation::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Compilation::destroy($ids);
    }

    public function createFromArray(array $data): Compilation {
        $compilation = new Compilation();
        $compilation->fill($data);
        $compilation->save();

        return $compilation;
    }

    public function updateFromArray(Compilation $compilation, array $data): Compilation {
        $compilation->update($data);
        return $compilation;
    }
}
