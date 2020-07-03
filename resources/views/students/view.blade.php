@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    <table class="table table-hover">
        <tr>
            <td>@lang('scheduler.full_name')</td>
            @php/** @var \App\Models\Student $student */@endphp
            <td>{{ $student->user->fullName }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.student_id')</td>
            <td>{{ $student->id_number }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.group') | @lang('scheduler.course')</td>
            <td>
                @php/** @var \App\Models\Group $group */@endphp
                @foreach($student->groups as $group)
                    <a href="{{ route('groups.show', $group->id) }}">{{ $group->number }}</a> |
                    {{--TODO добавить ссылку на курс--}}
                    <a href="#">{{ $group->course->number }}</a><br>
                @endforeach
            </td>
        </tr>
    </table>

    @can('update', $student)
        @include('blocks.buttons.update', [
            'src' => route('students.edit', $student->id),
        ])
    @endcan

    {{--TODO добавить ссылки на учебные план для групп--}}
    @foreach($student->groups as $group)
        @include('blocks.buttons.primary', [
        'buttonName' => __('scheduler.education_plan') . ': ' . $group->number,
        /** TODO ссылка на расписание */
        'src' => '#',
    ])
    @endforeach

    @can('delete', $student)
        @include('blocks.buttons.delete', [
            'src' => route('students.destroy', $student->id),
        ])
    @endcan
@endsection
