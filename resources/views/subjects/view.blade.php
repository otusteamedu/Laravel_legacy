@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.title') => 'Test',
            __('scheduler.teacher') => 'Test',
            __('scheduler.topics') => 'topic1, topic2',
        ],
    ])

    <a href="#" type="button" class="btn btn-primary">@lang('scheduler.education_plan')</a>
    <hr>
@endsection
