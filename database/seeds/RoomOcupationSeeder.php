<?php

use App\Models\Consultation;
use App\Models\EducationPlan;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Role;
use App\Models\Room;
use App\Models\RoomOccupation;
use App\Models\Schedule;
use App\Models\ScheduleType;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RoomOcupationSeeder extends Seeder
{
    protected $rooms;
    protected $plans;
    protected $schedules;
    protected $users;
    protected $subjects;
    protected $groups;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->rooms = Room::all();
        $this->plans = EducationPlan::all();
        $this->schedules = Schedule::byType(ScheduleType::LESSON)->get();
        $this->users = User::byRole(Role::TEACHER)->get();
        $this->subjects = Subject::all();
        $this->groups = Group::all();

        Collection::times(300, function (int $i): RoomOccupation {
            $occupationModel = $this->prepareOccupationModel();

            return RoomOccupation::firstOrCreate([
                'date' => factory(RoomOccupation::class)->make()->date,
                'room_id' => $this->rooms->random()->id,
                'schedule_id' => $this->schedules->random()->id,
                'occupationable_id' => $occupationModel->id,
                'occupationable_type' => get_class($occupationModel),
            ]);
        });
    }

    /**
     * @return Model
     */
    protected function prepareOccupationModel(): Model
    {
        if (rand(0, 1)) {
            return factory(Lesson::class)->create([
                'education_plan_id' => $this->plans->random()->id,
            ]);
        }

        return factory(Consultation::class)->create([
            'user_id' => $this->users->random()->id,
            'subject_id' => $this->subjects->random()->id,
            'group_id' => $this->groups->random()->id,
        ]);
    }
}
