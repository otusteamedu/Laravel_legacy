<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Status;
use Tests\Generators\UserGenerator;

class StatusRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateStatus()
    {
        $data['name'] = 'test_status';
        $status = factory(Status::class)->create($data);
        $this->assertDatabaseHas('statuses', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Check don't create status with the same email
     * @expectException PDOException
     */
    public function testCreateStatusFailsDublicate()
    {
        $data['name'] = 'test_status2';
        $statuses_count_before = Status::all()->count();
        $status = factory(Status::class)->create($data);
        $this->assertEquals($statuses_count_before + 1, Status::all()->count());

        $this->expectExceptionCode(23000);
        $this->expectExceptionMessageRegExp('/Duplicate entry/');

        $status = factory(Status::class)->create($data);
    }

    /**
     * Check don't create status with the empty data
     * @expectException QueryException
     */

    public function testCreateStatusFailsEmpty()
    {
        $data['name'] = null;
        $this->expectExceptionMessageRegExp('/ cannot be null/');
        $this->expectException(QueryException::class);
        $this->expectExceptionCode(23000);

        $status = factory(Status::class)->create($data);
    }

    public function testDeleteStatus()
    {
        $data['name'] = 'test_status2';
        $res = Status::where('name', $data['name'])->delete();
        $this->assertDatabaseMissing('statuses', [
            'name' => $data['name'],
        ]);
    }
}

