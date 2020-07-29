@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => route('posts.index'), 'method' => 'get']) !!}

    <div class="form-group">
        {{ Form::label('title', __('scheduler.title'), ['class' => 'control-label']) }}
        {{ Form::text(
            'title',
            $filter['title'],
            [
            'class' => 'form-control',
            ]
        ) }}
    </div>
    <div class="form-group">
        <div class="form-check form-check-inline">
            {{ Form::label('published', __('scheduler.public'), ['class' => 'form-check-input']) }}
            {{ Form::checkbox(
                'published',
                true,
                $filter['published'],
                ['class' => 'form-check-label', 'id' => 'published']
            ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('groups', __('scheduler.groups'), ['class' => 'control-label']) }}
        {{ Form::select(
            'groups[]',
            $groups,
            $filter['groups'],
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
