<?php


namespace App\Services\Record\Repositories;


use App\Models\Record;
use Illuminate\Support\Collection;

interface RecordRepositoryInterface
{
    /**
     * Return client's records
     *
     * @param int $clientId
     * @return Collection|null
     */
    public function getClientRecords(int $clientId): ?Collection;

    /**
     * Return master's records
     *
     * @param int $masterId
     * @return Collection|null
     */
	public function getMasterRecords(int $masterId): ?Collection;

    /**
     * Return record by id
     *
     * @param int $recordId
     * @return Record
     */
    public function getRecord(int $recordId): Record;

    /**
     * Create record
     *
     * @param array $recordData
     * @return Record
     */
    public function create(array $recordData): Record;
}
