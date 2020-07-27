<?php
namespace App\AdminLte;

use App\Models\User;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
        if(isset($item['can'])){
            $levelUser = \Auth::user()->level;
            //если пользователь, то не показываем основное меню
            if($levelUser==1){
                $item['restricted'] = true;
            }
            else{
                $item['restricted'] = false;
            }
        }

        return $item;
    }
}
