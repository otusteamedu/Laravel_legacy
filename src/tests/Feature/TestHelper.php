<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\BusinessType;
use App\Models\Procedure;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Вспомогательный класс для тестов
 */
class TestHelper extends TestCase
{
    /**
     * Создаст новый тип для салона и вернет business_type_id
     * @param Business $business
     * @return int
     */
    protected function getProcedure(Business $business): Procedure
    {
        $procedure = factory(Procedure::class)->create(["business_id" => $business->id]);
        return $procedure;
    }

    /**
     * Создаст новую запись салона для пользователя и вернет ее
     * @param User $user
     * @return Business
     */
    protected function getBusiness(User $user): Business
    {
        $type_id = $this->getBusinessType()->id;
        return factory(Business::class)->create([
            'user_id' => $user->id,
            'type_id' => $type_id
        ]);
    }

    /**
     * Вернет нового пользователя
     * @return User
     */
    protected function getUser(): User
    {
        $role = factory(UserRole::class)->create(['name' => Str::random()]);
        return factory(User::class)->create([
            'user_role_id' => $role->id
        ]);
    }

    /**
     * Вернет новый Тип
     * @return BusinessType
     */
    protected function getBusinessType(): BusinessType
    {
        $business_type = factory(BusinessType::class)->create();
        return $business_type;
    }
}
