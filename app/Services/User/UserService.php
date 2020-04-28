<?php

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 28.04.2020
 * Time: 9:33
 */
namespace App\Services\User;

use App\Models\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UsersService
{
    /**
     * получаем всех пользователей
     * @return Collection|static[]
     */
    public function all()
    {
        return User::all();
    }

}