<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Repositories\Interfaces\IModuleRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements IUserRepository
{
    private $sexes;
    /**
     * @var IModuleRepository
     */
    private $moduleRepository;
    /**
     * ModuleRepository constructor.
     * @param IModuleRepository $moduleRepository
     */
    public function __construct(IModuleRepository $moduleRepository) {
        parent::__construct();
        $this->moduleRepository = $moduleRepository;
        $this->sexes = [
            'male',
            'female'
        ];
    }
    /**
     * Список полов
     * @return array
     */
    public function getSexes(): array {
        return $this->sexes;
    }
    /**
     * @return User|null
     * @throws \App\Base\WrongNamespaceException
     */
    public function currentUser(): ?User
    {
        /** @var User $user */
        $user = $this->getByPrimary(Auth::id());
        return $user ?? null;
    }

    /**
     * Авторизация построена на уровнях доступа.
     * Метод принимает код модуля и минимальный уровень доступа
     * @param User $user
     * @param $moduleId
     * @param string $access
     * @return bool
     * @throws \App\Base\WrongNamespaceException
     */
    public function requiredAccess(User $user, $moduleId, string $access): bool
    {
        // суперадминам все можно
        if($user->isRoot())
            return true;
        // левый уровень доступа
        if(strlen($access) != 1)
            return false;
        // пользователь не активен
        if(!$user->active)
            return false;

        $builder = $user->roles()
            ->join('mod_perms', 'roles.id', '=', 'mod_perms.role_id')
            ->join('mod_accesses', 'mod_perms.access_id', '=', 'mod_accesses.id')
            ->join('modules', 'mod_accesses.module_id', '=', 'modules.id')
            ->where('mod_accesses.code', '>=', $access);

        if(is_numeric($moduleId))
            $builder->where('modules.id', '=', $moduleId);
        else
            $builder->where('modules.code', '=', $moduleId);

        return $builder->get()->isNotEmpty();
    }
}
