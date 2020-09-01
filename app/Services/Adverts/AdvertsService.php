<?php


namespace App\Services\Adverts;

use App\Http\Controllers\CookieController;
use App\Models\Advert;
use App\Models\User;
use App\Services\Adverts\Handler\StoreAdvertHandler;
use App\Services\Adverts\Repositories\AdvertCacheRepository;
use App\Services\Adverts\Repositories\AdvertRepositoryInterface;


class AdvertsService
{

    private $advertRepository;
    private $advertCacheRepository;
    private $advertHandler;
    private $cookieController;

    public function __construct(
                    AdvertRepositoryInterface $advertRepository,
                    AdvertCacheRepository $advertCacheRepository,
                    StoreAdvertHandler $advertHandler,
                    CookieController $cookieController
    )
    {
        $this->advertRepository = $advertRepository;
        $this->advertCacheRepository = $advertCacheRepository;
        $this->advertHandler = $advertHandler;
        $this->cookieController = $cookieController;
    }

    public function showItem($id)
    {
        $item = $this->advertRepository->find($id);
        return $item; //ItemDTO::make($item);
    }

    public function showAdvertList()
    {
        return $this->advertCacheRepository->cachingAdvertList();
    }

    public function showDivisionList()  //TODO взять из своего сервиса
    {
        $division =$this->advertRepository->divisionList();
        return ItemsDTO::make($division);
    }

    public function showTownList()  //TODO взять из своего сервиса
    {
        $town = $this->advertRepository->townList();
        return ItemsDTO::make($town);
    }

    public function pageApi(int $limit, int $offset)
    {
        return $this->advertCacheRepository->cachingPageApi($limit, $offset);
    }

    public function page($qty)
    {
        //$pages = $this->advertRepository->paginateList($qty);
        $pages = $this->advertCacheRepository->cachingPage($qty);
        //return PaginateDTO::make($pages);
        return $pages;
    }

    public function filteredPage($qty, $division_id, $town_id='all')
    {
        $pages = $this->advertRepository->filteredPaginateList($qty, $division_id, $town_id);
        //return PaginateDTO::make($pages);
        return $pages;
    }


    public function storeAdvert($data)
    {
         return $this->advertHandler->handle($data);
        //return $this->advertRepository->createFromArray($data);
    }

    public function updateAdvert(Advert $advert, array $data)
    {
        return $this->advertRepository->updateFromArray($advert, $data);
    }

    public function deleteAdvert(Advert $advert)
    {
        return $this->advertRepository->destroyFromObj($advert);
    }

    public function getHeaderData($request)
    {
        return
            [
                'divisionList' => $this->showDivisionList(),
                'townList' => $this->showTownList(),
                'town_id'  => $this->cookieController->getCookieTownId($request),
            ];

    }

    public function searchAdverts($request)
    {
        $adverts = Advert::query();
        $adverts->where(   //TODO old version
            [
                ['division_id', $request->division_id],
                ['town_id', $request->town_id],
                ['title', 'like', '%'.$request->text.'%']
            ] );
        $adverts->with('town', 'user', 'division');

        $pages = $adverts->paginate(10);

        //return PaginateDTO::make($pages);
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

    public function getUserAdverts($userId)
    {
        $adverts = Advert::query();
        $adverts->where('user_id', $userId );
        $adverts->with('town', 'user', 'division');

        return $adverts->paginate(10);
    }

    public function getUserInfo($userId) //TODO убрать в  UserService
    {
        return User::find($userId);

    }



}
