@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.group') => 211,
            __('scheduler.term') => 2,
        ],
    ])

    <a href="#" type="button" class="btn btn-primary">@lang('scheduler.education_plan')</a>
    <hr>
    <a href="#" type="button" class="btn btn-primary">@lang('scheduler.students')</a>
    <hr>
    <a href="#" type="button" class="btn btn-primary">@lang('scheduler.schedule')</a>
    <hr>
    <a href="#" type="button" class="btn btn-primary">@lang('scheduler.subject_programs')</a>
    <hr>
@endsection
