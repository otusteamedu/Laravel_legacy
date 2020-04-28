<?php

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 28.04.2020
 * Time: 9:33
 */
namespace App\Services\User;
use App\Services\User\Repositories\UserRepository;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UserService
{

    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }


    /**
     * получаем всех пользователей
     * @return Collection|static[]
     */
    public function all()
    {
        return $this->userRepository->all();
    }

}