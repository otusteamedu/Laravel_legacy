@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => route('students.index'), 'method' => 'get']) !!}

    <div class="form-group">
        {{ Form::label('last_name', __('users.last_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'last_name',
            $filter['last_name'],
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('course', __('scheduler.course'), ['class' => 'control-label']) }}
        {{ Form::select(
            'course',
            $courseList,
            $filter['course'],
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            'placeholder' => ''
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('group', __('scheduler.group'), ['class' => 'control-label']) }}
        {{ Form::select(
            'group',
            $groupList,
            $filter['group'],
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            'placeholder' => ''
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('id_number', __('scheduler.student_id'), ['class' => 'control-label']) }}
        {{ Form::number(
            'id_number',
            $filter['id_number'],
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
