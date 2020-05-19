@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::select(
            'group',
            ['1' => '111', '2' => '222'],
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
        {{ Form::label('term', __('scheduler.term'), ['class' => 'control-label']) }}
        {{ Form::select(
            'term',
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
        {{ Form::select(
            'teacher',
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

    {{Form::submit(__('scheduler.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
