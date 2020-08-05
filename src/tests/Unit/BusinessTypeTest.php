<?php

namespace Tests\Unit;

use App\Services\BusinessTypes\BusinessTypeService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTypeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Список типов
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetList()
    {
        $this->seed(\BusinessTypesTableSeeder::class);
        $service = $this->app->make(BusinessTypeService::class);

        $result = $service->list();

        $this->assertInstanceOf(Collection::class, $result);
    }
}
