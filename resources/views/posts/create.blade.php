@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.create'):</h4>

    {!! Form::open(['url' => '/']) !!}

    <div class="form-group">
        {{ Form::label('author', __('scheduler.author'), ['class' => 'control-label']) }}
        {{ Form::select(
            'author',
            [
                1 => 'Test',
                2 => 'Ivanov',
            ],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
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
    <div class="form-group">
        {{ Form::label('text', __('scheduler.text'), ['class' => 'control-label']) }}
        {{ Form::textarea(
            'text',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('date', __('scheduler.date'), ['class' => 'control-label']) }}
        {{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        <div class="form-check form-check-inline">
            {{ Form::label('public', __('scheduler.public'), ['class' => 'form-check-input']) }}
            {{ Form::radio('topic_type', 'lecture', null, ['class' => 'form-check-label', 'id' => 'public']) }}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::label('redaction', __('scheduler.redaction'), ['class' => 'form-check-input']) }}
            {{ Form::radio('topic_type', 'practice', null, ['class' => 'form-check-label', 'id' => 'redaction']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('groups', __('scheduler.groups'), ['class' => 'control-label']) }}
        {{ Form::select(
            'groups',
            [
                1 => '111',
                2 => '211',
            ],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('subjects', __('scheduler.subjects'), ['class' => 'control-label']) }}
        {{ Form::select(
            'subjects',
            [
                1 => 'math',
                2 => 'chemistry',
            ],
            null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
