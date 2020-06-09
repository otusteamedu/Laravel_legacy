@extends('layouts.general')

@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>

        {!! Form::open(['route' => ['password.update'], 'method' => 'POST']) !!}

        {!! Form::hidden('token', $token) !!}

        <div class="form-group">
            {!! Form::label('email', __('auth/reset.form.email.label')) !!}
            {!! Form::email('email', $email, ['class' => 'form-control', 'placeholder' => __('auth/reset.form.email.placeholder')]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', __('auth/reset.form.password.label')) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('auth/reset.form.password.placeholder')]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation', __('auth/reset.form.password_confirmation.label')) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('auth/reset.form.password_confirmation.placeholder')]) !!}
        </div>

        {!! Form::submit(__('auth/reset.form.submit'), ['class' => 'btn btn-primary']) !!}

        <span class="ml-2">{!! __('auth/reset.form.auth', ['link' => '/']) !!}</span>

        {!! Form::close() !!}
    </div>
@endsection
