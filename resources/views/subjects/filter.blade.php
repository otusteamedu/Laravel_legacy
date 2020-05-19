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
        {{ Form::label('title', __('scheduler.title'), ['class' => 'control-label']) }}
        {{ Form::text(
            'title',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
