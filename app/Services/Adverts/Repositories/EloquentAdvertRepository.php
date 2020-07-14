<?php


namespace App\Services\Adverts\Repositories;


use App\Models\Advert;
use App\Models\Division;
use App\Models\Town;



class EloquentAdvertRepository implements AdvertRepositoryInterface
{

    public function find(int $id)
    {
        return Advert::find($id);
    }

    public function list()
    {
        return Advert::with('town', 'user', 'division')->get();
    }

    public function divisionList()
    {
        return Division::all()->toArray();
    }

    public function townList()
    {
        return Town::all()->toArray();
    }

    public function paginateList($qty)
    {
        return Advert::with('town', 'user', 'division')->paginate($qty);
    }

    public function createFromArray(array $data): Advert
    {
//        $advert = new Advert();
////        $advert->create($data);   $advert->save($data);  // если create то id в модели не проставится
////        return $advert;
            return Advert::create($data);
    }

    public function updateFromArray(Advert $advert, array $data)
    {
        $advert->update($data);
        return $advert;
    }

    public function destroyFromObj(Advert $advert)
    {
        $advert->delete();
    }

}
