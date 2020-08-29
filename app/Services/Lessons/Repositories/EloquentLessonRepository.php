<?php

namespace App\Services\Lessons\Repositories;

use App\Models\Group;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class EloquentLessonRepository
 * @package App\Services\Lessons\Repositories
 */
class EloquentLessonRepository implements LessonRepositoryInterface
{
    /**
     * @param Carbon $date
     * @param Group $group
     * @return Collection
     */
    public function getLessonsByDateAndGroup(Carbon $date, Group $group): Collection
    {
        $columns = [
            'id',
            'education_plan_id',
        ];

        return Lesson::select($columns)
            ->whereHas('occupation', function (Builder $builder) use ($date) {
                $builder->where('date', $date);
            })
            ->whereHas('educationPlan', function (Builder $builder) use ($group) {
                $builder->where('group_id', $group->id);
            })
            ->with([
                'educationPlan:id,subject_id,group_id,user_id,lesson_type_id',
                'educationPlan.lessonType:id,type',
                'educationPlan.subject:id,name',
                'educationPlan.group:id,number',
                'educationPlan.teacher:id,last_name,name,second_name',
                'occupation:date,room_id,schedule_id,occupationable_id,occupationable_type',
                'occupation.room:id,number',
                'occupation.schedule:id,interval',
            ])
            ->get();
    }
}
