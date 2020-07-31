<?php
namespace App\AdminLte;

use App\Models\User;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item): array
    {
        $user = new User();
        $item = $user->isNeedToCheckAccess($item);
        return $item;
    }
}