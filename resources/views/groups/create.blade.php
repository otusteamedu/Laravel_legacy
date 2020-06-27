@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.create'):</h4>

    {!! Form::open(['url' => route('groups.store')]) !!}

    <div class="form-group">
        {{ Form::label('number', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::number(
            'number',
            old('number'),
            [
            'class' => 'form-control',
            'min' => 1,
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('course_id', __('scheduler.course'), ['class' => 'control-label']) }}
        {{ Form::select(
            'course_id',
            $courses,
            old('course_id'),
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('education_year_id', __('scheduler.education_year'), ['class' => 'control-label']) }}
        {{ Form::select(
            'education_year_id',
            $years,
            old('education_year_id') ?? session(\App\Services\Helpers\Session::EDUCATION_YEAR),
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.save'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
