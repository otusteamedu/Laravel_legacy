@extends('layouts.general')

@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>
        {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('email', __('auth/recover.form.email.label')) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('auth/recover.form.email.placeholder')]) !!}
        </div>
        {!! Form::submit(__('auth/recover.form.submit'), ['class' => 'btn btn-primary']) !!}
        <span class="ml-2">{!! __('auth/recover.form.auth', ['link' => '/']) !!}</span>
        {!! Form::close() !!}
    </div>
@endsection
