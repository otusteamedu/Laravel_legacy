<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Shedule
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $interval
 * @property int $schedule_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \App\Models\ScheduleType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereScheduleTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule byType($type)
 */
	class Schedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EducationYear
 *
 * @property int $id
 * @property string $start_at
 * @property string $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Course|null $course
 * @property-read string $period
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear current()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear date(\Carbon\Carbon $date)
 */
	class EducationYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Room
 *
 * @property int $id
 * @property string $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RoomOccupation[] $occupations
 * @property-read int|null $occupations_count
 */
	class Room extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EducationPlan
 *
 * @property int $id
 * @property int $hours
 * @property int $subject_id
 * @property int $group_id
 * @property int|null $user_id
 * @property int $lesson_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereLessonTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Group $groups
 * @property-read \App\Models\LessonType $lessonType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 * @property-read \App\Models\Group $group
 */
	class EducationPlan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LessonType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationPlan[] $educationPlans
 * @property-read int|null $education_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectProgram[] $programs
 * @property-read int|null $programs_count
 */
	class LessonType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SheduleType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereUpdatedAt($value)
 */
	class ScheduleType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property string|null $published_at
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $producer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post byGroups($groupsId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post byTitle($title)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post isPublished()
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Group
 *
 * @property int $id
 * @property int $number
 * @property int $course_id
 * @property int $education_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereEducationYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationPlan[] $educationPlans
 * @property-read int|null $education_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $teachers
 * @property-read int|null $teachers_count
 * @property-read \App\Models\EducationYear $year
 * @property-read string $group_course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $receivePosts
 * @property-read int|null $receive_posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group courseNumber($courseId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group number($number)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group teacherName($name)
 */
	class Group extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $date
 * @property int $room_id
 * @property int $education_plan_id
 * @property int $schedule_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereEducationPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\EducationPlan $educationPlan
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Schedule $schedule
 * @property-read \App\Models\RoomOccupation|null $occupation
 */
	class Lesson extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Chat
 *
 * @property int $id
 * @property int $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Student $student
 */
	class Chat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Consultation
 *
 * @property int $id
 * @property string $date
 * @property int|null $limit
 * @property bool $approved
 * @property int $room_id
 * @property int $user_id
 * @property int $schedule_id
 * @property int $subject_id
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Group $group
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Schedule $schedule
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 * @property-read \App\Models\RoomOccupation|null $occupation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation approved()
 */
	class Consultation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubjectProgram
 *
 * @property int $id
 * @property string $title
 * @property mixed|null $meta
 * @property int $sort
 * @property int $subject_id
 * @property int $user_id
 * @property int $lesson_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereLessonTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\LessonType $lessonType
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 */
	class SubjectProgram extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationPlan[] $educationPlans
 * @property-read int|null $education_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectProgram[] $programs
 * @property-read int|null $programs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $teacher
 * @property-read int|null $teacher_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $teachers
 * @property-read int|null $teachers_count
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Course
 *
 * @property int $id
 * @property int $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course number($number)
 */
	class Course extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RoomOccupation
 *
 * @property int $id
 * @property string $date
 * @property int $room_id
 * @property int $schedule_id
 * @property int $occupationable_id
 * @property string $occupationable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $occupationable
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Schedule $schedule
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereOccupationableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereOccupationableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RoomOccupation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string|null $second_name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSecondName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationPlan[] $educationPlans
 * @property-read int|null $education_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectProgram[] $programs
 * @property-read int|null $programs_count
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $receivePosts
 * @property-read int|null $receive_posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $sendPosts
 * @property-read int|null $send_posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @property string|null $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User byRole($roleId)
 * @property-read string $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TelegramUser[] $telegramUsers
 * @property-read int|null $telegram_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User email($email)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User lastName($lastName)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocale($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property bool $serialized
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSerialized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property int $id_number
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chat
 * @property-read int|null $chat_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $group
 * @property-read int|null $group_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student idNumber($idNumber)
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withoutTrashed()
 * @mixin \Eloquent
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withoutTrashed()
 * @mixin \Eloquent
 */
	class CacheModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TelegramUser
 *
 * @property int $id
 * @property bool|null $is_bot
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property string $language_code
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereIsBot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereLanguageCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereUsername($value)
 */
	class TelegramUser extends \Eloquent {}
}

namespace App\Pivots{
/**
 * App\Pivots\SubjectTeacher
 *
 * @property int $subject_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereUserId($value)
 * @mixin \Eloquent
 */
	class SubjectTeacher extends \Eloquent {}
}

