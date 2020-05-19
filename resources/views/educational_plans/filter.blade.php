@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('groups', __('scheduler.groups'), ['class' => 'control-label']) }}
        {{ Form::select(
            'groups',
            ['1' => '1', '2' => '1'],
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
        {{ Form::label('subjects', __('scheduler.subjects'), ['class' => 'control-label']) }}
        {{ Form::select(
            'subjects',
            ['1' => '1', '2' => '1'],
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
        {{ Form::label('teacher', __('scheduler.teacher'), ['class' => 'control-label']) }}
        {{ Form::text(
            'teacher',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
