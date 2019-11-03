<?php

namespace App\Services\Compilations;

use App\Models\Compilation;
use App\Services\Compilations\Repositories\CompilationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CompilationService {

    private $compilationRepository;

    public function __construct(CompilationRepositoryInterface $compilationRepository) {
        $this->compilationRepository = $compilationRepository;
    }

    public function findCompilation(int $id) {
        return $this->compilationRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchCompilations(): LengthAwarePaginator {
        return $this->compilationRepository->search();
    }

    /**
     * @param array $data
     * @return Compilation
     */
    public function storeCompilation(array $data): Compilation {
        return $this->compilationRepository->createFromArray($data);
    }

    /**
     * @param Compilation $category
     * @param array $data
     */
    public function updateCompilation(Compilation $compilation, array $data) {
        $this->compilationRepository->updateFromArray($compilation, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyCompilation(array $ids) {
        $this->compilationRepository->destroy($ids);
    }
}
