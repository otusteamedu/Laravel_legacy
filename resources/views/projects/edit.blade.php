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

        {!!Form::submit(trans('projects.form.save'))->attrs(['data-disable-with'=>trans('projects.form.save_in_progress')]) !!}
        {!! Form::close() !!}


        <div class="mt-5">
        @include('projects.partials.delete')
        </div>


    </div>

@endsection
