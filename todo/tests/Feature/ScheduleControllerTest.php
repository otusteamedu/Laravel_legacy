<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Style;
use Tests\Generators\ScheduleGenerator;
use Tests\Generators\UserGenerator;
use Illuminate\Support\Facades\Auth;

/**
 * @group schedule
 * */
class ScheduleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function createUserAndActingAs()
    {
        $user = UserGenerator::createUserAdminWithRole(['name' => 'test_user', 'email' => 'admin@mail.ru']);
        $this->actingAs($user, 'api');
    }

    public function testScheduleList()
    {
        $this->createUserAndActingAs();
        $amount = 1;
        //factory(___Schedule::class, $amount)->create();
        ScheduleGenerator::createSchedule(
            [
                'style_id' => 1,
                'instructor_id' => 1,
                'days' => 'gcg',
                'time' => '19-20'
            ]
        );
        $response = $this->getJson(route('schedule.index'));

        //dd($response->content());
        $response->assertStatus(200)
            ->assertJsonStructure([
                    '*' => [
                        'style_id',
                        'instructor_id',
                        'instructor', 'style',
                        'days',
                        'time'
                    ]
                ]

            )
            ->assertJsonCount($amount);
    }

    public function testAddNewSchedule()
    {
        $this->createUserAndActingAs();

        $before = Schedule::count();
        factory(Style::class, 1)->create(['style_id' => 1]);
        factory(Instructor::class, 1)->create(['instructor_id' => 1]);
        $response = $this->postJson(route('schedule.store'),
            [
                'style_id' => 1,
                'instructor_id' => 1,
                'days' => 'gcg',
                'time' => '19-20'
            ]
        );

        $id = $response->json('id');
        $schedule = Schedule::find($id);
        if (is_null($schedule)) {
            $this->fail('___Schedule id not created');
        }
        $this->assertEquals(1, Schedule::count() - $before);
        $response->assertStatus(200);

    }

    public function testAddNewScheduleWithWrongData()
    {
        $this->createUserAndActingAs();

        $before = Schedule::count();
        factory(Style::class, 1)->create(['style_id' => 1]);
        factory(Instructor::class, 1)->create(['instructor_id' => 1]);
        $response = $this->postJson(route('schedule.store'),
            [
                'style_id' => 1,
                'instructor_id' => 1,
                //'days' => 'gcg',
                //'time' => '19-20'
            ]
        );
        $this->assertEquals(0, Schedule::count() - $before);
        $response->assertStatus(422);

    }


    public function testUpdateSchedule()
    {
        $this->createUserAndActingAs();
        $schedules = ScheduleGenerator::createSchedule(
            [
                'style_id' => 1,
                'instructor_id' => 1,
                'days' => 'gcg',
                'time' => '19-20'
            ]
        );

        $schedule_id = $schedules->random()->id;
        $days = 'new days';
        $time = 'new time';

        $response = $this->json('PUT', route('schedule.update', ['id' => $schedule_id]),
            [
                'style_id' => 1,
                'instructor_id' => 1,
                'days' => $days,
                'time' => $time
            ]
        );

        $scheduleUpdated = Schedule::find($schedule_id);

        $this->assertEquals($days, $scheduleUpdated->days);
        $this->assertEquals($time, $scheduleUpdated->time);


        //$this->assertEquals(0, ___Schedule::count()- $before);
        $response->assertStatus(200);

    }

    public function testUpdateScheduleWrongData()
    {
        $this->createUserAndActingAs();
        $old_days = 'псп';
        $old_time = '19-20';
        $schedules = ScheduleGenerator::createSchedule(
            [
                'style_id' => 1,
                'instructor_id' => 1,
                'days' => $old_days,
                'time' => $old_time
            ]
        );

        $schedule_id = $schedules->random()->id;
        $days = '1';
        $time = 'new time new time new time new time new time';

        $response = $this->putJson(route('schedule.update', ['id' => $schedule_id]),
            [
                'style_id' => 1,
                'instructor_id' => 1,
                'days' => '',
                'time' => ''
            ]
        );
        $scheduleUpdated = Schedule::find($schedule_id);
        $this->assertEquals($old_days, $scheduleUpdated->days);
        $this->assertEquals($old_time, $scheduleUpdated->time);

        $response->assertStatus(422);

    }


    public function testDeleteSchedule()
    {
        $this->createUserAndActingAs();
        $schedules = ScheduleGenerator::createSchedule(
            [
                'style_id' => 1,
                'instructor_id' => 1,
                'days' => 'gcg',
                'time' => '19-20'
            ]
        );
        $schedule_id = $schedules->random()->id;
        $response = $this->deleteJson(route('schedule.destroy', ['id' => $schedule_id]));

        $this->assertNull(Schedule::find($schedule_id));
        $response->assertOk()->assertJson(['deleted' => 'true']);


    }


}
