@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.full_name') => 'Test',
            __('scheduler.student_id') => 'xxx',
            __('scheduler.term') => 2,
            __('scheduler.group') => 211,
        ],
    ])

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

    @include('blocks.buttons.update', [
        'src' => route('students.edit', $student->id),
    ])

    {{--TODO добавить ссылки на учебные план для групп--}}
    @foreach($student->groups as $group)
        @include('blocks.buttons.primary', [
        'buttonName' => __('scheduler.education_plan') . ': ' . $group->number,
        /** TODO ссылка на расписание */
        'src' => '#',
    ])
    @endforeach

    @include('blocks.buttons.delete', [
        'src' => route('students.destroy', $student->id),
    ])
@endsection
