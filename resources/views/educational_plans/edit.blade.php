@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.edit'):</h4>

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
        {{ Form::label('subjects_teachers', __('scheduler.subjects'), ['class' => 'control-label']) }}
        {{ Form::select(
            'subjects_teachers',
            ['1' => 'math - Testov', '2' => 'chemistry Ivanov'],
            null,
            [
            'class' => 'selectpicker form-control',
            'multiple',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
