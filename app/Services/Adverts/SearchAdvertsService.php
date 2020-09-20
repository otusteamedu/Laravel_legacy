<?php


namespace App\Services\Adverts;


use App\Models\Advert;
use App\Services\Adverts\Repositories\AdvertRepositoryInterface;

class SearchAdvertsService    //TODO тоже интерфейс нужен
{
    private $advertRepository;

    public function __construct(AdvertRepositoryInterface $advertRepository)
    {

        $this->advertRepository = $advertRepository;
    }

    public function filteredPage($qty, $division_id, $town_id='all')
    {
        $pages = $this->advertRepository->filteredPaginateList($qty, $division_id, $town_id);
        return $pages;
    }


    public function fullTextSearchAdverts($request, $qty)
    {
        $query = mb_strtolower($request->text, 'UTF-8');
        $stringToArray = explode(" ", $query);

        $query = [];
        foreach ($stringToArray as $word)
        {
            $query[] = $word . "*";
        }
        $query = array_unique($query, SORT_STRING);
        $query = implode(" ", $query);

        $results = Advert::query();
        $results->whereRaw("MATCH(title, content) AGAINST(? IN BOOLEAN MODE)",$query);

        ($request->division_id=='selected')? :$results->where('division_id', $request->division_id);
        ($request->town_id=='selected')? :$results->where('town_id', $request->town_id);

        return $results->paginate($qty) ;
    }



//    public function searchAdverts($request) // old version
//    {
//        $adverts = Advert::query();
//        $adverts->where(
//            [
//                ['division_id', $request->division_id],
//                ['town_id', $request->town_id],
//                ['title', 'like', '%'.$request->text.'%']
//            ] );
//        $adverts->with('town', 'user', 'division');
//
//        $pages = $adverts->paginate(10);
//
//        //return PaginateDTO::make($pages);
//        return $pages;
//
//    }

}
