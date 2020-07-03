@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.edit'):</h4>

    {!! Form::open(['url' => route('students.update', $student), 'method' => 'put']) !!}

    <div class="form-group">
        {{ Form::label('last_name', __('users.last_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'last_name',
            old('last_name') ?? $student->user->last_name,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', __('users.name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'name',
            old('name') ?? $student->user->name,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('second_name', __('users.second_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'second_name',
            old('second_name') ?? $student->user->second_name,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('group_id', __('scheduler.group') . ' | ' . __('scheduler.course'), ['class' => 'control-label']) }}
        {{ Form::select(
            'group_id',
            $groupList,
            old('group_id') ?? $studentGroupsId,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            'multiple',
            'name' => 'group_id[]',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('id_number', __('scheduler.student_id'), ['class' => 'control-label']) }}
        {{ Form::text(
            'id_number',
            old('id_number') ?? $student->id_number,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.save'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
