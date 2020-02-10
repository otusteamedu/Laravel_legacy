<!-- Stored in resources/views/page_registration/registration.blade.php -->

@extends('common_layouts.common')

@section('h1', __('registration.pageHead'))

@section('maincontent')
    {{ Form::open(['url' => '/boo/moo/woo/', 'method' => 'put']) }}
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                {{ Form::label('fname', trans('registration.fname')) }}
                {{ Form::text('fname', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('mname', trans('registration.mname')) }}
                {{ Form::text('mname', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('lname', trans('registration.lname')) }}
                {{ Form::text('lname', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('registration.email')) }}
                {{ Form::text('email', null, array('class' => 'form-control')) }}
            </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::submit(trans('registration.submit'), array('class' => 'btn btn-success')) }}
    </div>
    {{ Form::close() }}
@endsection
