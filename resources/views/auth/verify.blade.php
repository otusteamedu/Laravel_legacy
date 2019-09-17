@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    {{ __('Verify Your Email Address') }}
                </p>
            </header>

            <div class="card-content">
                <div class="content">
                    @if (session('resent'))
                        <p class="help is-success">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </p>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="button is-link">{{ __('click here to request another') }}</button>
                        .
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
