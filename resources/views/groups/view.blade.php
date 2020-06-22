@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    <table class="table table-hover">
        <tr>
            <td>@lang('scheduler.group')</td>
            @php/** @var \App\Models\Group $group */@endphp
            <td>{{ $group->number }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.course')</td>
            <td>
                {{--TODO ссылка на список курсов с фильтрацией--}}
                <a href="#">{{ $group->course->number }}</a></td>
        </tr>
        <tr>
            <td>@lang('scheduler.education_year')</td>
            <td>
                {{--TODO ссылка на список рабочих программ с фильтрацией--}}
                <a href="#">{{ $group->year->period }}</a>
            </td>
        </tr>
    </table>

    @include('blocks.buttons.update', [
        'src' => route('groups.edit', $group->id),
    ])

    @include('blocks.buttons.primary', [
        'buttonName' => __('scheduler.students'),
        /** TODO ссылка на список студентов с фильтрацией */
        'src' => '#',
    ])

    @include('blocks.buttons.primary', [
        'buttonName' => __('scheduler.subject_programs'),
        /** TODO ссылка на расписание */
        'src' => '#',
    ])


    @include('blocks.buttons.delete', [
        'src' => route('groups.destroy', $group->id),
    ])
@endsection
