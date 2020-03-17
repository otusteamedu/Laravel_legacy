<?php


namespace App\Services\Record;


use App\Models\Record;
use App\Services\Record\Repositories\RecordRepositoryInterface;
use Illuminate\Support\Collection;

class RecordService
{
    protected RecordRepositoryInterface $recordRepository;

    public function __construct(RecordRepositoryInterface $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    /**
     * Return client's records
     *
     * @param int $clientId
     * @return Collection|null
     */
    public function getClientRecords(int $clientId): ?Collection
    {
        return $this->recordRepository->getClientRecords($clientId);
    }

    /**
     * Return master's records
     *
     * @param int $masterId
     * @return Collection|null
     */
    public function getMasterRecords(int $masterId): ?Collection
    {
        return $this->recordRepository->getMasterRecords($masterId);
    }

    /**
     * Return record by id
     *
     * @param int $recordId
     * @return Record
     */
    public function getRecord(int $recordId): Record
    {
        return $this->recordRepository->getRecord($recordId);
    }

    /**
     * Create record
     *
     * @param array $recordData
     * @return Record
     */
	public function create(array $recordData): Record
    {
        return $this->recordRepository->create($recordData);
	}
}
