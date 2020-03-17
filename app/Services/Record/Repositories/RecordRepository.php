<?php


namespace App\Services\Record\Repositories;


use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RecordRepository implements RecordRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getClientRecords(int $clientId): ?Collection
    {
        return Record::whereClientId($clientId)
            ->orderBy('date_start', 'desc')
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getMasterRecords(int $masterId): Collection
    {
        return Record::whereMasterId($masterId)
            ->orderBy('date_start', 'desc')
            ->with('client')
            ->get()
            ->groupBy(static function ($item) {
                /** @var Record $item */
                return Carbon::parse($item->date_start)->format('Ymd');
            });
    }

    /**
     * @inheritDoc
     */
    public function getRecord(int $recordId): Record
    {
        return Record::find($recordId);
    }

    /**
     * @inheritDoc
     */
    public function create(array $recordData): Record
    {
        $record = new Record();
        return $this->fillAndSave($record, $recordData);
    }

    public function update(int $recordId, array $recordData): Record
    {
        $record = Record::findOrFail($recordId);
        return $this->fillAndSave($record, $recordData);
    }

    protected function fillAndSave(Record $record, $recordData): Record
    {
        $record->client_id = (int)$recordData['client_id'];
        $record->master_id = (int)$recordData['master_id'];
        $record->date_start = $recordData['date_start'];
        $record->date_finish = $recordData['date_finish'];
        $record->price = $recordData['price'];

        if(!$record->save()) {
            throw new \LogicException('Record save error.');
        }

        return $record;
    }

    /**
     * @inheritDoc
     */
    public function masterHasRecord(int $masterId, int $recordId): bool
    {
        return Record::where('id', '=', $recordId)
            ->where('master_id', '=', $masterId)
            ->first('id') !== null;
    }
}
