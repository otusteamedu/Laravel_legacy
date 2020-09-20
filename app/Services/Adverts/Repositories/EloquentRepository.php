<?php


namespace App\Services\Adverts\Repositories;


use App\Models\Advert;
use App\Models\Division;
use App\Models\Town;



class EloquentRepository implements AdvertRepositoryInterface
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

    public function filteredPaginateList($qty, $division_id, $town_id)
    {
        $advert = Advert::query();
        $town_id!='all'
            ? $advert->where([['division_id', $division_id],['town_id', $town_id] ])
            : $advert->where('division_id', $division_id );
        $advert->with('town', 'user', 'division');

        return $advert->paginate($qty);
    }

    public function paginateListApi(int $limit, int $offset)
    {
        $advert = Advert::query();
        if ($limit) $advert->take($limit);
        if($offset) $advert->skip($offset);

        $advert->with('town', 'user', 'division');
        return $advert->get(['adverts.*']); // ???
    }

    public function filteredByUserAdverts(int $userId)
    {
        $adverts = Advert::query();
        $adverts->where('user_id', $userId );
        $adverts->with('town', 'user', 'division');

        return $adverts->paginate(10); //todo magic digit - to const
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
