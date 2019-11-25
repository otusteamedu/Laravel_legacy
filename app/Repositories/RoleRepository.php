<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\Role;
use App\Repositories\Interfaces\IRoleRepository;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository extends BaseRepository implements IRoleRepository
{
    /**
     * @return array
     * @throws \App\Base\WrongNamespaceException
     */
    public function getList4Perms(): array {
        return parent::getList()->filter(function($value, $key) {
            /** @var Role $value */
            return $value->code != 'root';
        })->toArray();
    }
}
