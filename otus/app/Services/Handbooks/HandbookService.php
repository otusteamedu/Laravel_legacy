<?php

namespace App\Services\Handbooks;

use App\Models\Handbook;
use App\Services\Handbooks\Repositories\HandbookRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HandbookService {

    private $authorRepository;

    public function __construct(HandbookRepository $authorRepository) {
        $this->authorRepository = $authorRepository;
    }

    public function findHandbook(int $id) {
        return $this->authorRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchHandbooks(): LengthAwarePaginator {
        return $this->authorRepository->search();
    }

    /**
     * @param array $data
     * @return Handbook
     */
    public function storeHandbook(array $data) : Handbook {
        return $this->authorRepository->createFromArray($data);
    }

    /**
     * @param Handbook $author
     * @param array $data
     */
    public function updateHandbook(Handbook $author, array $data) {
        $this->authorRepository->updateFromArray($author, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyHandbook(array $ids) {
       $this->authorRepository->destroy($ids);
    }
}
