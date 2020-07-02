<?php


namespace App\Services\Adverts\Handler;

use App\Models\Advert;
use App\Services\Adverts\Jobs\SendEmailAfterMakeAdvert;
use App\Services\Adverts\Repositories\AdvertRepositoryInterface;

class StoreAdvertHandler
{

    /**
     * @var AdvertRepositoryInterface
     */
    private $advertRepository;

    public function __construct(AdvertRepositoryInterface $advertRepository)
    {

        $this->advertRepository = $advertRepository;
    }


    /**
     * Execute the job.
     *
     * @param $data
     * @return Advert
     */
    public function handle($data)
    {
        $advert = $this->advertRepository->createFromArray($data);

        SendEmailAfterMakeAdvert::dispatch($advert);

        return $advert;
    }

}
