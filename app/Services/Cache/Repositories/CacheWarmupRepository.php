<?php


namespace App\Services\Cache\Repositories;


class CacheWarmupRepository
{

    // Fill this array manually if you warm up cache
    private $warm_models_list = ['Filter'];

    public function getWarmModelsList() : array
    {
        return $this->warm_models_list;
    }



}
