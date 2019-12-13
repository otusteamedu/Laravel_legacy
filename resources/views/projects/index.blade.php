@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex align-items-center">
            <div>
                <h1 class="title">@lang('projects.title')</h1>
            </div>
            <div class="pl-5">
                <a class="btn btn-primary" role="button" href="{{ route('projects.create') }}">
                    <i class="fa fa-plus"></i> @lang('projects.create')
                </a>
            </div>
        </div>

        <div class="mt-5">
        @if($projects->count())
            @include('projects.partials.list')
        @else
            <p>@lang('projects.no_projects')</p>
            <a class="button is-primary is-outlined"
               href="{{ route('projects.create') }}"><i class="fa fa-plus"></i>&nbsp;@lang('projects.create')</a>
        @endif
        </div>
    </div>

@endsection
