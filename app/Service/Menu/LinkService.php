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
        return $this->linkRepository->paginate(5);
    }
}
