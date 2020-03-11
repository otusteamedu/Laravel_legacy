<?php
/**
 * Eloquent репозиторий для валют
 */

namespace App\Services\Currencies\Repositories;

use App\Models\Currency;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;

class EloquentCurrencyRepository implements CurrencyRepositoryInterface
{

    public function find(int $id)
    {
        return Currency::find($id)->toArray();
    }

    public function search(array $filters = [])
    {
        if (isset($filters['code'])) {
            return Currency::where('code', $filters['code'])->orderBy('id', 'desc')->paginate();
        }
        return Currency::orderBy('id', 'desc')->paginate();
    }

    public function all()
    {
        $currencies = Currency::all()->toArray();
        array_multisort(array_column($currencies, 'code'), SORT_ASC, $currencies);
        $result = [];

        foreach ($currencies as $item) {
            $result[$item['id']] = $item['code'];
        }
        return $result;
    }

    public function createFromArray(array $data)
    {
        return Currency::insertOrIgnore($data);
    }

    public function updateFromArray($id, array $data)
    {
        return Currency::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Currency::where('id', $id)->delete();
    }
}
