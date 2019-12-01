<?php

namespace App\Services\Handbooks;

use App\Models\Handbook;
use App\Services\Handbooks\Repositories\CachedHandbookRepositoryInterface;
use App\Services\Handbooks\Repositories\HandbookRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HandbookService {

    private $handbookRepository;
    private $cachedHandbookRepository;

    public function __construct(HandbookRepositoryInterface $handbookRepository, CachedHandbookRepositoryInterface $cachedHandbookRepository) {
        $this->handbookRepository = $handbookRepository;
        $this->cachedHandbookRepository = $cachedHandbookRepository;
    }

    public function findHandbook(int $id): Handbook {
        return $this->handbookRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchHandbooks(): LengthAwarePaginator {
        return $this->cachedHandbookRepository->search();
    }

    /**
     * @param array $data
     * @return Handbook
     */
    public function storeHandbook(array $data) : Handbook {
        return $this->handbookRepository->createFromArray($data);
    }

    /**
     * @param Handbook $author
     * @param array $data
     */
    public function updateHandbook(Handbook $author, array $data) {
        $this->handbookRepository->updateFromArray($author, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyHandbook(array $ids) {
       $this->handbookRepository->destroy($ids);
    }
}
