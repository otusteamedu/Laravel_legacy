<?php


namespace App\Services\Users\Repositories;


interface CachedUserRepositoryInterface
{

    public function search(array $filters = [], array $with = []);

    public function clearSearchCache();

}