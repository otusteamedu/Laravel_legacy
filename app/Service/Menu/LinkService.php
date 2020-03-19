<?php


namespace App\Service\Menu;


use App\Contract\Repository\Menu\LinkRepositoryInterface;
use App\Contract\Service\Menu\LinkServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LinkService
 * @package App\Service\Menu
 *
 * Сервис ссылок
 */
class LinkService implements LinkServiceInterface
{
    /** @var int Размер страницы */
    protected const PAGE_SIZE = 5;

    /** @var LinkRepositoryInterface Репозиторий ссылок меню */
    private $linkRepository;

    /**
     * LinkService constructor.
     * @param LinkRepositoryInterface $linkRepository Репозиторий ссылок
     */
    public function __construct(LinkRepositoryInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    /** @inheritDoc */
    public function getList(): LengthAwarePaginator
    {
        return $this->linkRepository->paginate(self::PAGE_SIZE);
    }

    /** @inheritDoc */
    public function create(array $data): int
    {
        return $this->linkRepository->create($data);
    }

    /** @inheritDoc */
    public function update(int $id, array $data)
    {
        $this->linkRepository->update($id, $data);
    }

    /** @inheritDoc */
    public function destroy(int $id)
    {
        $this->linkRepository->destroy($id);
    }
}
