<?php
/**
 */

namespace App\Services\Prices\Repositories;


use App\Models\Price;

class EloquentPriceRepository implements PriceRepositoryInterface
{

    public function find(int $id)
    {
        return Price::find($id);
    }

    public function search(array $filters = [])
    {
        return Price::paginate();

    }

    public function searchToArray(array $filters = [])
    {
        return Price::all();
    }

    public function createFromArray(array $data): Price
    {
        $price = new Price();
        $price = $price->create($data);


        return $price;
    }

    public function updateFromArray(Price $price, array $data)
    {
        $result = Price::where('description', $data['description'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $price->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $price->update($data);
        return 1;
    }

    public function create(array $data): Price
    {
        return $this->createFromArray($data);
    }

    public function delete(int $id)
    {
        return Price::destroy($id);
    }

}