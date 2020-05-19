@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::select(
            'group',
            ['1' => '111', '2' => '211'],
            null,
            [
            'class' => 'selectpicker form-control',
            'multiple',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('teachers', __('scheduler.teachers'), ['class' => 'control-label']) }}
        {{ Form::select(
            'teachers',
            ['1' => 'Test', '2' => 'Ivanov'],
            null,
            [
            'class' => 'selectpicker form-control',
            'multiple',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('rooms', __('scheduler.rooms'), ['class' => 'control-label']) }}
        {{ Form::select(
            'rooms',
            ['1' => '101', '2' => '102'],
            null,
            [
            'class' => 'selectpicker form-control',
            'multiple',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        <div class="form-check form-check-inline">
            {{ Form::label('topic_type_lecture', __('scheduler.lecture'), ['class' => 'form-check-input']) }}
            {{ Form::checkbox('topic_type', 'lecture', null, ['class' => 'form-check-label', 'id' => 'topic_type_lecture']) }}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::label('topic_type_practice', __('scheduler.practice'), ['class' => 'form-check-input']) }}
            {{ Form::checkbox('topic_type', 'practice', null, ['class' => 'form-check-label', 'id' => 'topic_type_practice']) }}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::label('consultation', __('scheduler.consultation'), ['class' => 'form-check-input']) }}
            {{ Form::checkbox('topic_type', 'consultation', null, ['class' => 'form-check-label', 'id' => 'consultation']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('week', __('scheduler.week'), ['class' => 'control-label']) }}
        {{ Form::select(
            'week',
            ['1' => '2020-01-27 - 2020-02-02', '2020-02-03' => '2020-02-09'],
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
