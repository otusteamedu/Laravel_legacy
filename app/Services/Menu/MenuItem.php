<?php
namespace App\Services\Menu;

use App\Repository\MenuRepository;

class MenuItem
{
    /**
     * Item's title.
     *
     * @var string
     */

    public $title;


    /**
     * Item's url.
     *
     * @var string
     */

    public $url;


    /**
     * Item's imgUrl.
     *
     * @var string
     */

    public $imgUrl;


    /**
     * Item's cssId.
     *
     * @var string
     */

    public $cssId;


    /**
     * Item's cssClass.
     *
     * @var string
     */

    public $cssClass;

    /**
     * Item's other.
     *
     * @var string
     */

    public $other;


    /**
     * Item's active.
     *
     * @var boolean
     */

    public $active;


    /**
     * Item's subMenu.
     *
     * @var string
     */

    public $subMenu;


   public function __construct(
       $title,
       $url,
       $imgUrl = '',
       $cssId = '',
       $cssClass = '',
       $other = '',
       $active = false

   ){

       $this->title = $title;
       $this->url = $url;
       $this->active = $active;
       $this->imgUrl = $imgUrl;
       $this->cssId = $cssId;
       $this->cssClass = $cssClass;
       $this->other = $other;

     return $this;
   }

   public function addSubMenu(MenuItem $subMenu){
       $this->subMenu = $subMenu;

       return $this;
   }
}
