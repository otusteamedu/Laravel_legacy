@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('subjects', __('scheduler.subjects'), ['class' => 'control-label']) }}
        {{ Form::select(
            'subjects',
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
        {{ Form::label('teacher', __('scheduler.teacher'), ['class' => 'control-label']) }}
        {{ Form::text(
            'teacher',
            null,
            [
            'class' => 'form-control',
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
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
