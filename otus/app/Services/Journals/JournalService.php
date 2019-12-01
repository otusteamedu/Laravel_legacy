<?php

namespace App\Services\Journals;

use App\Models\Journal;
use App\Services\Journals\Repositories\CachedJournalRepositoryInterface;
use App\Services\Journals\Repositories\JournalsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class JournalService {

    private $journalsRepository;
    private $cachedJournalRepository;

    public function __construct(JournalsRepositoryInterface $journalsRepository, CachedJournalRepositoryInterface $cachedJournalRepository) {
        $this->journalsRepository = $journalsRepository;
        $this->cachedJournalRepository = $cachedJournalRepository;
    }

    public function findJournal(int $id): Journal {
        return $this->journalsRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchJournals(array $filters = [], array $with = []): LengthAwarePaginator {
        return $this->cachedJournalRepository->search($filters, $with);
    }

    /**
     * @param array $data
     * @return Journal
     */
    public function storeJournal(array $data) : Journal {
        return $this->journalsRepository->createFromArray($data);
    }

    /**
     * @param Journal $journal
     * @param array $data
     */
    public function updateJournal(Journal $journal, array $data) {
        $this->journalsRepository->updateFromArray($journal, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyJournal(array $ids) {
        $this->journalsRepository->destroy($ids);
    }
}
