@extends('layouts.general')

@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>

        <p>{{ __('auth/confirm.text') }}</p>

        {!! Form::open(['route' => ['password.confirm'], 'method' => 'POST']) !!}

        <div class="form-group">
            {!! Form::label('password', __('auth/confirm.form.password.label')) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('auth/confirm.form.password.placeholder')]) !!}
        </div>

        {!! Form::submit(__('auth/reset.form.submit'), ['class' => 'btn btn-primary']) !!}

        @if (Route::has('password.request'))
            <span class="ml-2">{!! __('auth/reset.form.request', ['link' => route('password.request')]) !!}</span>
        @endif

        {!! Form::close() !!}
    </div>
@endsection
