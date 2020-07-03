@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    <table class="table table-hover">
        <tr>
            <td>@lang('scheduler.full_name')</td>
            @php/** @var \App\Models\User $teacher */@endphp
            <td>{{ $teacher->fullName }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.email')</td>
            <td>{{ $teacher->email }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.subjects')</td>
            <td>
                @php/** @var \App\Models\Subject $subject */@endphp
                @foreach($teacher->subjects as $subject)
                    {{--TODO заменить ссылку на роут--}}
                    <a href="subjects/{{ $subject->id }}">{{ $subject->name }}</a><br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>@lang('scheduler.teaching_load')</td>
            @php/** @var \App\Services\EducationPlans\EducationPlanService $educationPlanService */@endphp
            <td>{{ $educationPlanService->getHoursForEducationPlans($teacher->educationPlans) }}</td>
        </tr>
    </table>

    @can('update-teacher')
    @include('blocks.buttons.update', [
        'src' => route('teachers.edit', $teacher),
    ])
    @endcan

    @include('blocks.buttons.primary', [
        'buttonName' => __('scheduler.education_plan'),
        /** TODO ссылка на учебный план с фильтром по преподавателю*/
        'src' => 'education_plans',
    ])

    @can('delete-teacher')
    @include('blocks.buttons.delete', [
        'src' => route('teachers.destroy', $teacher),
    ])
    @endcan
@endsection
