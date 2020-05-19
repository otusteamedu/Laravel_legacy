@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('full_name', __('scheduler.full_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'full_name',
            null,
            [
            'class' => 'form-control',
            'data-max-options' => '20',
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
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::select(
            'group',
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
        {{ Form::label('student_id', __('scheduler.student_id'), ['class' => 'control-label']) }}
        {{ Form::text(
            'student_id',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
