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

    /** @inheritDoc */
    public function create(array $data): int
    {
        $link = new Link($data);
        $link->save();
        return $link->id;
    }

    /** @inheritDoc */
    public function update(int $id, array $data): bool
    {
        $link = Link::find($id);
        $link->fill($data);
        return $link->save();
    }

    /** @inheritDoc */
    public function destroy(int $id): bool
    {
        return Link::destroy([$id]) === 1;
    }
}
