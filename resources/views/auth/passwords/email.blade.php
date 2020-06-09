@extends('layouts.general')

@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        {!! Form::open(['route' => ['password.email'], 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('email', __('auth/reset.form.email.label')) !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => __('auth/reset.form.email.placeholder')]) !!}
        </div>
        {!! Form::submit(__('auth/reset.form.submit'), ['class' => 'btn btn-primary']) !!}
        <span class="ml-2">{!! __('auth/reset.form.auth', ['link' => '/']) !!}</span>
        {!! Form::close() !!}
    </div>
@endsection
