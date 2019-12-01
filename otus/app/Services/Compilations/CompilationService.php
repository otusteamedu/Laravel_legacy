<?php

namespace App\Services\Compilations;

use App\Models\Compilation;
use App\Services\Compilations\Repositories\CachedCompilationRepositoryInterface;
use App\Services\Compilations\Repositories\CompilationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CompilationService {

    private $compilationRepository;
    private $cachedCompilationRepository;

    public function __construct(CompilationRepositoryInterface $compilationRepository, CachedCompilationRepositoryInterface $cachedCompilationRepository) {
        $this->compilationRepository = $compilationRepository;
        $this->cachedCompilationRepository = $cachedCompilationRepository;
    }

    public function findCompilation(int $id): Compilation {
        return $this->compilationRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchCompilations(array $filters = [], array $with = []): LengthAwarePaginator {
        return $this->cachedCompilationRepository->search($filters, $with);
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
