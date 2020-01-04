@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex align-items-center">
            <h1 class="title">@lang('projects.title_create')</h1>
            <div class="pl-5">
                <a href="{{ route('projects.index') }}">@lang('projects.back')</a>
            </div>
        </div>


        {!! Form::open()->route('projects.store')->locale('projects.form')!!}

        @include('projects.partials.form_fields')

        {!!Form::submit(trans('projects.form.create'))->attrs(['data-disable-with' => _('projects.form.create_in_progress')]) !!}

        {!! Form::close() !!}

    </div>

@endsection
