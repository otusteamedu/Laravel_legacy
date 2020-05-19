@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.edit'):</h4>

    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('full_name', __('scheduler.full_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'full_name',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('login', __('scheduler.login'), ['class' => 'control-label']) }}
        {{ Form::text(
            'login',
            null,
            [
            'class' => 'form-control',
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
        {{ Form::label('teaching_load', __('scheduler.teaching_load'), ['class' => 'control-label']) }}
        {{ Form::text(
            'teaching_load',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
