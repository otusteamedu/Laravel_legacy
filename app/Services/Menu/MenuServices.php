<?php

namespace App\Services\Menu;

use App\Repository\MenuRepository;

class MenuServices
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function all()
    {
        return MenuRepository::all();
    }
}
