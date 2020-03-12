<?php


namespace App\Services\Record;


use App\Models\Record;
use App\Services\Record\Repositories\RecordRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class RecordService
{
    public const CACHE_TAG = self::class;
    public const CACHE_MASTER_RECORDS_MASK = 'master.%s.records';

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
        return Cache::tags(self::CACHE_TAG)->rememberForever(
            sprintf(self::CACHE_MASTER_RECORDS_MASK, $masterId),
            function () use ($masterId) {
                return $this->recordRepository->getMasterRecords($masterId);
            }
        );
    }

    /**
     * Return record by id
     *
     * @param int $recordId
     * @return Record
     */
    public function get(int $recordId): Record
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

    /**
     * @param int $masterId
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
	public function clearMasterRecordsCache(int $masterId): void
    {
        \Cache::delete($this->getMasterRecordsCacheKey($masterId));
    }

    public function clearCache(): void
    {
        \Cache::tags(self::CACHE_TAG)->flush();
    }

    /**
     * @param int $masterId
     * @return string
     */
    public function getMasterRecordsCacheKey(int $masterId): string
    {
        return sprintf(self::CACHE_MASTER_RECORDS_MASK, $masterId);
    }

    /**
     * @param int $recordId
     * @param array $recordData
     * @return Record
     */
    public function update(int $recordId, array $recordData): Record
    {
        return $this->recordRepository->update($recordId, $recordData);
    }
}
