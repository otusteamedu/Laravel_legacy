@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.create'):</h4>

    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('title', __('scheduler.title'), ['class' => 'control-label']) }}
        {{ Form::text(
            'title',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('teacher', __('scheduler.teacher'), ['class' => 'control-label']) }}
        {{ Form::select(
            'teacher',
            ['1' => '1', '2' => '2'],
            null,
            [
            'class' => 'selectpicker form-control',
            'multiple',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
