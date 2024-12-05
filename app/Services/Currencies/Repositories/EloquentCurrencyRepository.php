<?php
/**
 * Eloquent репозиторий для валют
 */

namespace App\Services\Currencies\Repositories;

use App\Models\Currency;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;

class EloquentCurrencyRepository implements CurrencyRepositoryInterface
{

    /**
     * @param int $id
     * @return Currency|Currency[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return Currency::find($id);
    }

    /**
     * @param string $code
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByCode($code = '')
    {
        if ($code) {
            return Currency::where('code', 'like', '%' . $code . '%')->orderBy('id', 'desc')->paginate();
        }
        return Currency::orderBy('id', 'desc')->paginate();
    }

    /**
     * @return array
     */
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

    /**
     * @param array $data
     * @return Currency
     */
    public function createFromArray(array $data)
    {
        $currency = new Currency();
        $currency->create($data);
        return $currency;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Currency|Currency[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateFromArray($id, array $data)
    {
        $currency = $this->find($id);
        $currency->update($data);
        return $currency;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return Currency::where('id', $id)->delete();
    }
}
