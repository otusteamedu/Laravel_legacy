<?php
/**
 * Created by PhpStorm.
 * User: romchik
 * Date: 08.10.2019
 * Time: 13:36
 */

namespace App\Services\Role;


use App\Models\User\Role;
use Illuminate\Support\Facades\Log;

class RoleService
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Получаем все роли
     * @return Role[]|bool|\Illuminate\Database\Eloquent\Collection
     */
    public function getRoles()
    {
        try {
            $result = $this->role->all();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            //TODO: выводить flash сообщение, что что-то пошло не так
            $result = false;
        } finally {
            return $result;
        }
    }
}