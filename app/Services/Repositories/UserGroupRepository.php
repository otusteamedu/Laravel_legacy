<?php

namespace App\Services\Repositories;

use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserGroupRepository
{
    /**
     * @param $id
     * @return UserGroup|null
     */
    public function find($id)
    {
        return UserGroup::find($id);
    }

    /**
     * @param array $columns
     * @return UserGroup[]|Collection
     */
    public function getAll(array $columns = ['*'])
    {
        return UserGroup::all($columns);
    }


    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function paginated(array $options = null)
    {
        return UserGroup::paginate();
    }

    /**
     * @param array|null $options
     * @return array
     */
    public function getList(array $options = null)
    {
        $userGroups = UserGroup::all(['id', 'name']);
        $userGroupList = [];
        foreach ($userGroups as $userGroup) {
            $userGroupList[$userGroup->id] = $userGroup->title;
        }
        return $userGroupList;
    }

    /**
     * @param array|null $options
     * @return int
     */
    public function getIdByName(string $name)
    {
        $userGroup = UserGroup::where('name', $name)->first();

        return $userGroup->id;
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return UserGroup[]|Collection|null
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        //
    }

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return UserGroup|null
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        //
    }

    /**
     * @param array $data
     * @return UserGroup|Model
     */
    public function createFromArray(array $data)
    {
        return UserGroup::create($data);
    }

    /**
     * @param UserGroup $userGroup
     * @param array $data
     * @return UserGroup|Model
     */
    public function updateFromArray(UserGroup $userGroup, array $data)
    {
        $userGroup->update($data);

        return $userGroup;
    }

    /**
     * @param UserGroup $userGroup
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(UserGroup $userGroup, array $options = null)
    {
        return $userGroup->delete();
    }
}
