<?php

namespace App\Services\Events\Models\Journal;

use App\Models\Journal;

class JournalEvent {
    /** @var Journal */
    private $journal;

    public function __construct(Journal $journal) {
        $this->journal = $journal;
    }

    /**
     * @return Journal
     */
    public function getJournal(): Journal {
        return $this->journal;
    }
}
