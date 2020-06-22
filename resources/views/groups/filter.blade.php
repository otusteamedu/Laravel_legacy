@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => route('groups.index'), 'method' => 'get']) !!}

    <div class="form-group">
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::number(
            'group',
            $filter['group'],
            [
            'class' => 'form-control',
            'min' => 1,
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('course', __('scheduler.course'), ['class' => 'control-label']) }}
        {{ Form::number(
            'course',
            $filter['course'],
            [
            'class' => 'selectpicker form-control',
            'min' => 1,
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('teacher', __('scheduler.teacher'), ['class' => 'control-label']) }}
        {{ Form::text(
            'teacher',
            $filter['teacher'],
            [
            'class' => 'selectpicker form-control',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
