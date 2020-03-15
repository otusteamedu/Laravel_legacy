<?php


namespace App\Services\Portal\Menu;


use Illuminate\Http\Request;
use Lavary\Menu\Builder;
use Lavary\Menu\Menu;

abstract class AbstractMenuService
{
    /** @var Menu  */
    protected $menu;

    /** @var Request  */
    protected $request;

    /** @var string $menuName */
    protected $menuName;

    /**
     * Menu constructor.
     * @param Menu $menu
     * @param Request $request
     */
    public function __construct(Menu $menu, Request $request)
    {
        $this->menu = $menu;
        $this->request = $request;
    }

    /**
     * создаем меню
     */
    public function createMenu(): void
    {
        $this->menu
            ->make($this->menuName, function (Builder $menu) {
                $this->makeMenu($menu);
            });
    }

    /**
     * @param Builder $menu
     */
    public function makeMenu(Builder $menu): void
    {
        $tree = $this->getTree();

        foreach ($tree as $item) {

            $params = [
                'url' => $item['url'],
                'class' => $item['class'] ?? '',
            ];

            $menu->add($item['name'], $params);
        }
    }

    /**
     * @return array
     */
    abstract protected function getTree(): array;
}