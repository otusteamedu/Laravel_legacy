@extends('layouts.app')

@section('content')

    <div class="container">

        @include('projects.partials.view_header')

        @include('projects.partials.tabs')

        {!! Form::open()->fill($project)->route('projects.update', ['project' => $project])->locale('projects.form')->autocomplete('off')->patch() !!}
        <div class="mt-3">
            <div class="row">
                <div class="col-6">


                    @include('projects.partials.form_fields')



                </div>
            </div>
        </div>

        {!!Form::submit(trans('projects.form.update'))!!}
        {!! Form::close() !!}


    </div>

@endsection
