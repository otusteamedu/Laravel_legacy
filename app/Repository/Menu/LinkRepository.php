<?php

namespace App\Repository\Menu;

use App\Contract\Repository\Menu\LinkRepositoryInterface;
use App\Model\Menu\Link;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LinkRepository
 * @package App\Repository\Menu
 *
 * Репозиторий ссылок меню
 */
class LinkRepository implements LinkRepositoryInterface
{
    /** @inheritDoc */
    public function paginate(int $size): LengthAwarePaginator
    {
        return Link::paginate($size);
    }
}
