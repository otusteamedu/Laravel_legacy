<?php


namespace App\Repository;

use App\Models\Menu;
use App\Services\Menu\MenuItem;

class MenuRepository
{
   public static function all(){


       return collect([
           new MenuItem(__('menu.home'),'','','','mdi-home'),
           new MenuItem(__('menu.lang-constructor'),'lang-constructor','','','mdi-contacts'),
           new MenuItem(__('menu.lang-constructor-type'),'lang-constructor-type','','','mdi-contacts'),
           new MenuItem(__('menu.bot-settings'),'bot-settings','','','mdi-chart-bar'),
       ]);

   }
}
