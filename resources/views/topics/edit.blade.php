@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.edit'):</h4>

    {!! Form::open(['url' => '/', 'files' => true]) !!}

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
        <div class="form-check form-check-inline">
            {{ Form::label('topic_type_lecture', __('scheduler.lecture'), ['class' => 'form-check-input']) }}
            {{ Form::radio('topic_type', 'lecture', null, ['class' => 'form-check-label', 'id' => 'topic_type_lecture']) }}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::label('topic_type_practice', __('scheduler.practice'), ['class' => 'form-check-input']) }}
            {{ Form::radio('topic_type', 'practice', null, ['class' => 'form-check-label', 'id' => 'topic_type_practice']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('annotation', __('scheduler.annotation'), ['class' => 'control-label']) }}
        {{ Form::textarea(
            'annotation',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('questions', __('scheduler.questions'), ['class' => 'control-label']) }}
        {{ Form::text(
            'questions',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
        <a href="#">
            <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
            </svg>
            @lang('buttons.add')
        </a>
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
        {{ Form::label('bibliography', __('scheduler.bibliography'), ['class' => 'control-label']) }}
        {{ Form::text(
            'bibliography',
            null,
            [
            'class' => 'form-control',
            ]
           ) }}
        <a href="#">
            <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
            </svg>
            @lang('buttons.add')
        </a>
    </div>
    <div class="form-group">
        <div class="custom-file">
            {{ Form::label('files', __('buttons.attach'), ['class' => 'custom-file-label']) }}
            {{ Form::file('files', [
                'class' => 'custom-file-input',
                'multiple',
            ]) }}
        </div>
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
