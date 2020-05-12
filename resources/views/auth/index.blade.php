@extends('layouts.general')

@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>
        {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('email', __('auth/general.form.email.label')) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('auth/general.form.email.placeholder')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', __('auth/general.form.password.label')) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('auth/general.form.password.placeholder')]) !!}
            <small class="form-text"><a href="/auth/recover/">{{ __('auth/general.form.recover') }}</a></small>
        </div>
        <div class="form-group form-check">
            <label for="remember">
                {!! Form::checkbox('remember', '1', false,  ['id' => 'remember', 'class' => 'form-check-input']) !!}
                {{ __('auth/general.form.remember_me') }}
            </label>
        </div>
        {!! Form::submit(__('auth/general.form.submit'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
