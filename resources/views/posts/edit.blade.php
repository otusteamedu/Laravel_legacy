@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.edit'):</h4>

    {!! Form::open(['url' => route('posts.update', $post), 'method' => 'put']) !!}

    <div class="form-group">
        {{ Form::label('title', __('scheduler.title'), ['class' => 'control-label']) }}
        {{ Form::text(
            'title',
            old('title') ?? $post->title,
            [
                'class' => 'form-control',
                'required' => true,
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('body', __('scheduler.text'), ['class' => 'control-label']) }}
        {{ Form::textarea(
            'body',
            old('body') ?? $post->body,
            [
                'class' => 'form-control',
                'required' => true,
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('groups', __('scheduler.groups'), ['class' => 'control-label']) }}
        {{ Form::select(
            'groups[]',
            $groups,
            old('groups') ?? $post->groups->pluck('id'),
            [
                'class' => 'selectpicker form-control',
                'multiple',
                'data-max-options' => '20',
                'data-live-search' => 'true',
                'required' => true,
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.update'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
