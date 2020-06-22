@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.create'):</h4>

    {!! Form::open(['url' => route('groups.store')]) !!}

    <div class="form-group">
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::number(
            'group',
            old('group'),
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
            old('course'),
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
            old('year') ?? session(\App\Services\Helpers\Session::EDUCATION_YEAR),
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
