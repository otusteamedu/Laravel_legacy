@extends('layouts.general')

@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('auth/verify.success_sent') }}
            </div>
        @endif

        {{ __('auth/verify.texts.check') }}
        {{ __('auth/verify.texts.if_not') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth/verify.texts.again') }}</button>.
        </form>
    </div>
@endsection
