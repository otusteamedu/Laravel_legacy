<?php

namespace App\Http\Repositories\Users\Cache;

use App\Helpers\Cache\CacheKeyManager;
use App\Helpers\Cache\Prefix;
use App\Helpers\Cache\Tag;
use App\Http\Repositories\CoreRepository;
use App\Http\Repositories\Users\UsersRepository;
use App\Models\User AS Model;
use Illuminate\Support\Facades\Cache;

class CacheUsersRepository extends CoreRepository
{

    const DEFAULT_TIME_USER = 600;

    const USER_PAGINATE_COUNT = 500;

    protected $cacheKeyManager;
    protected $usersRepository;

    public function __construct(
        CacheKeyManager $cacheKeyManager,
        UsersRepository $usersRepository
    ) {
        parent::__construct();
        $this->cacheKeyManager = $cacheKeyManager;
        $this->usersRepository = $usersRepository;
    }

    protected function getModelClass(){
        return Model::class;
    }

    public function getUserFromAdmin(){

        $key = $this->cacheKeyManager->getPaginateKey(Prefix::ADMIN_USERS_PREFIX);

        $result =  
            Cache::tags([Tag::ADMIN_TAG, Tag::ADMIN_USER_TAG])
                ->remember($key, self::DEFAULT_TIME_USER, function () 
                {
                    return $this->usersRepository->getUserFromAdmin(self::USER_PAGINATE_COUNT);
                });

        return $result;

    }

    public function getAllUsersFromRoot()
    {
        $key = $this->cacheKeyManager->getListKey(Prefix::ADMIN_USERS_PREFIX);

        $result = 
            Cache::tags([Tag::ADMIN_TAG, Tag::ADMIN_USER_TAG])
            ->remember($key, self::DEFAULT_TIME_USER, function () 
            {
                return $this->usersRepository->getUserFromRoot(self::USER_PAGINATE_COUNT);
            });
        return $result;
    }

    public function clearAdminUserCache(){
        Cache::tags([Tag::ADMIN_USER_TAG])->flush();
    }

}
