<?php

namespace App\Observers\Record;

use App\Models\Record;
use App\Services\Record\RecordService;

class RecordObserver
{
    protected RecordService $recordService;

    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;
    }

    /**
     * Handle the user group right "created" event.
     *
     * @param \App\Models\Record $record
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function created(Record $record): void
    {
        $this->recordService->clearMasterRecordsCache($record->master_id);
    }

    /**
     * Handle the user group right "updated" event.
     *
     * @param \App\Models\Record $record
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function updated(Record $record): void
    {
        $this->recordService->clearMasterRecordsCache($record->master_id);
    }

    /**
     * Handle the user group right "deleted" event.
     *
     * @param \App\Models\Record $record
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function deleted(Record $record): void
    {
        $this->recordService->clearMasterRecordsCache($record->master_id);
    }

    /**
     * Handle the user group right "restored" event.
     *
     * @param \App\Models\Record $record
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function restored(Record $record): void
    {
        $this->recordService->clearMasterRecordsCache($record->master_id);
    }

    /**
     * Handle the user group right "force deleted" event.
     *
     * @param \App\Models\Record $record
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function forceDeleted(Record $record): void
    {
        $this->recordService->clearMasterRecordsCache($record->master_id);
    }
}
