@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.create'):</h4>

    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('teacher', __('scheduler.teacher'), ['class' => 'control-label']) }}
        {{ Form::select(
            'teacher',
            [
                1 => '101',
                2 => '102',
                3 => '103',
            ],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::select(
            'group',
            ['1' => '1', '2' => '1'],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('subject', __('scheduler.subject'), ['class' => 'control-label']) }}
        {{ Form::select(
            'subject',
            ['1' => '1', '2' => '1'],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('date', __('scheduler.date'), ['class' => 'control-label']) }}
        {{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('lesson_time', __('scheduler.lesson_time'), ['class' => 'control-label']) }}
        {{ Form::select(
            'lesson_time',
            [
                1 => '8:00 - 10:35',
                2 => '10:45 - 12:20',
                3 => '12:30 - 14:05',
            ],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('room', __('scheduler.room'), ['class' => 'control-label']) }}
        {{ Form::select(
            'room',
            [
                1 => '101',
                2 => '102',
                3 => '103',
            ],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
