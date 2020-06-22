@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.edit'):</h4>

    {!! Form::open(['url' => route('groups.update', $group->id), 'method' => 'PUT']) !!}

    <div class="form-group">
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::number(
            'group',
            old('group') ?? $group->number,
            [
            'class' => 'form-control',
            'min' => 1,
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('course', __('scheduler.course'), ['class' => 'control-label']) }}
        {{ Form::select(
            'course',
            $courses,
            old('course') ?? $group->course->id,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('year', __('scheduler.education_year'), ['class' => 'control-label']) }}
        {{ Form::select(
            'year',
            $years,
            old('year') ?? $group->year->id,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.update'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
