<?php

namespace App\Services\Groups;

use App\DTOs\GroupDTO;
use App\DTOs\GroupFilterDTO;
use App\Models\Course;
use App\Models\Group;
use App\Models\Role;
use App\Services\Groups\Handlers\CreateGroupHandler;
use App\Services\Groups\Handlers\DeleteGroupHandler;
use App\Services\Groups\Handlers\UpdateGroupHandler;
use App\Services\Groups\Wrappers\GroupsByHrefWrapper;
use App\Services\Groups\Repositories\GroupRepositoryInterface;
use App\Services\Helpers\DTOHelper;
use App\Services\Helpers\Settings;
use App\Services\Interfaces\CacheService;
use App\Services\Traits\CacheClearable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class GroupService
 * @package App\Services\Groups
 */
class GroupService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'GROUP';

    /** @var  GroupRepositoryInterface */
    protected $repository;
    /** @var CreateGroupHandler */
    protected $createGroupHandler;
    /** @var UpdateGroupHandler */
    protected $updateGroupHandler;
    /** @var DeleteGroupHandler */
    protected $deleteGroupHandler;
    /** @var GroupsByHrefWrapper */
    protected $groupsByHrefWrapper;

    /**
     * GroupService constructor.
     * @param GroupRepositoryInterface $repository
     * @param CreateGroupHandler $createGroupHandler
     * @param UpdateGroupHandler $updateGroupHandler
     * @param DeleteGroupHandler $deleteGroupHandler
     * @param GroupsByHrefWrapper $groupsByHrefWrapper
     */
    public function __construct(
        GroupRepositoryInterface $repository,
        CreateGroupHandler $createGroupHandler,
        UpdateGroupHandler $updateGroupHandler,
        DeleteGroupHandler $deleteGroupHandler,
        GroupsByHrefWrapper $groupsByHrefWrapper
    ) {
        $this->repository = $repository;
        $this->createGroupHandler = $createGroupHandler;
        $this->updateGroupHandler = $updateGroupHandler;
        $this->deleteGroupHandler = $deleteGroupHandler;
        $this->groupsByHrefWrapper = $groupsByHrefWrapper;
    }

    public function cacheWarm(): void
    {
        $this->getTableTitles();
        $this->groupSelectList();
        $this->selectListWithCourse();
    }

    /**
     * Список групп с пагинацией
     * @param GroupFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function paginate(GroupFilterDTO $DTO): LengthAwarePaginator
    {
        return $this->repository->getGroupsListPaginate(Settings::PER_PAGE, $DTO);
    }

    /**
     * Названия колонок для списка групп
     * @return array
     */
    public function getTableTitles(): array
    {
        return [__('scheduler.group'), __('scheduler.course')];
    }

    /**
     * @param GroupDTO $DTO
     * @return Group
     */
    public function store(GroupDTO $DTO): Group
    {
        return $this->createGroupHandler->handle($DTO);
    }

    /**
     * @param GroupDTO $DTO
     * @param Group $group
     * @return Group
     */
    public function update(GroupDTO $DTO, Group $group): Group
    {
        return $this->updateGroupHandler->handle($DTO, $group);
    }

    /**
     * @param Group $group
     * @return bool
     */
    public function delete(Group $group): bool
    {
        return $this->deleteGroupHandler->handle($group);
    }

    /**
     * Возвращает коллекцию курсов из коллекции групп
     * @param Collection $groups
     * @return Collection
     */
    public function getCoursesFromGroupCollection(Collection $groups): Collection
    {
        return $groups->map(function (Group $group): Course {
            return $group->course;
        });
    }

    /**
     * Оборачивает группы в тег a
     * Возвращает коллекцию {id => <a href="http://otus-laravel.test/dashboard/groups/id">number</a>}
     * @param Collection $groups
     * @return Collection
     */
    public function wrapGroupsByHref(Collection $groups): Collection
    {
        return $this->groupsByHrefWrapper->wrap($groups);
    }

    /**
     * Возвращает список групп вида [id => number]
     * @param Role|null $userRole
     * @return array
     */
    public function groupSelectList(Role $userRole = null): array
    {
        return $this->repository->selectList($userRole)->toArray();
    }

    /**
     * Возвращает список вида [group_id => group_number | course_number]
     * @return array
     */
    public function selectListWithCourse(): array
    {
        return $this->repository->selectListWithCourse()->toArray();
    }

    /**
     * @param array $ids
     * @return Collection
     */
    public function getIdsFromArray(array $ids): Collection
    {
        return DTOHelper::getIdsDTOFromArray($ids);
    }

    /**
     * @param int $number
     * @return Group|null
     */
    public function getByNumber(int $number): ?Group
    {
        return $this->repository->getByNumber($number);
    }
}
