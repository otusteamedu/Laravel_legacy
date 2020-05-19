@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.full_name') => 'Test',
            __('scheduler.student_id') => 'xxx',
            __('scheduler.term') => 2,
            __('scheduler.group') => 211,
        ],
    ])

    <a href="#" type="button" class="btn btn-primary">@lang('scheduler.education_plan')</a>
    <hr>
@endsection
