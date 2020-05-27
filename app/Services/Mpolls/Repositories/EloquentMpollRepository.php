<?php


namespace App\Services\Mpolls\Repositories;


use App\Models\Mpoll;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentMpollRepository implements MpollRepositoryInterface
{
    public function find(int $id)
    {
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $query = Mpoll::query()->with([
            'users:id,name'
        ]);
        $this->applyFilters($query, $filters);
        return $query->paginate();
//        return Mpoll::paginate();
    }

    public function createFromArray(array $data): Mpoll
    {
        try {
            DB::beginTransaction();
            $mpoll = Mpoll::create($data);
            if (isset($data['quotas'])) {
                for ($i = 0; $i < count($data['quotas']); $i++) {
                    $quota_indx = $data['quotas'][$i];
                    $tmp[$quota_indx]['completes'] = $data['completes'][$i];
                    $tmp[$quota_indx]['sent'] = $data['sent'][$i];
                }
                $mpoll->quotas()->attach($tmp);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }

        return $mpoll;
    }

    public function updateFromArray(Mpoll $mpoll, array $data)
    {
        $mpoll->update($data);
        $mpoll->quotas()->detach();
        $quotas = $data['quotas'] ?? 0;
        $completes = $data['completes'] ?? 0;
        $sents = $data['sent'] ?? 0;
        if ($quotas) {
            for ($quota = 0; $quota < count($quotas); $quota++) {
                if ($quotas[$quota] != '') {
                    $mpoll->quotas()->attach($quotas[$quota], [
                        'completes' => $completes[$quota],
                        'sent' => $sents[$quota]
                    ]);
                }
            }
        }
    }

    public function destroy($mpoll)
    {
        return $mpoll->delete();
    }

    ### PRIVATE

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }






}
